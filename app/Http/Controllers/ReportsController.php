<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Credit;
use App\Models\Expense;
use App\Models\MaintenanceRecord;
use App\Models\Reservation;
use App\Models\Vehicle;
use DB;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function assets()
    {
        $vehicles = Vehicle::select('name', 'purchase_cost')
            ->whereNull('deleted_at')
            ->where('is_active', 1);

        $assets = Asset::select('name', 'cost')
            ->whereNull('deleted_at')
            ->union($vehicles)
            ->orderBy('name')
            ->get();

        return view('reports.assets', compact('assets'));
    }

    public function topCustomers()
    {
        $records = Reservation::join('customers', 'customers.id', '=', 'reservations.primary_driver_id')
            ->select(
                'customers.fullname',
                DB::raw('SUM(reservations.total_rent) as total_rent'),
                DB::raw('COUNT(1) as reservation_count'),
                DB::raw('ROUND(AVG(reservations.total_rent), 2) as average_rent')
            )->groupBy('customers.fullname')
            ->orderByDesc(DB::raw('SUM(reservations.total_rent)'))
            ->get();

        return view('reports.top_customers', compact('records'));
    }

    public function vehicleUsage()
    {
        return view('reports.vehicle_usage');
    }

    public function showVehicleUsage(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $query = 'SELECT
                 v.name
                ,AVG(r.average_daily_rent) AS average_price
                ,MAX(sv.total_days_in_service) AS total_days_in_service
                ,SUM(r.total_days) AS total_days_rented
                ,SUM(r.total_days * r.average_daily_rent) AS total_income
                FROM (
                    SELECT
                     id
                    ,vehicle_id
                    ,status
                    ,reserved_from
                    ,reserved_to
                    ,CASE WHEN DATEDIFF(reserved_to, reserved_from) > 0 THEN DATEDIFF(reserved_to, reserved_from) ELSE 1 END AS total_days
                    ,average_daily_rent
                    FROM (
                         SELECT
                          id
                         ,vehicle_id
                         ,status
                         ,GREATEST( :from ,reserved_from) AS reserved_from
                         ,LEAST( :to ,reserved_to) AS reserved_to
                         ,total_rent/total_days AS average_daily_rent
                         FROM reservations
                     ) AS sr
                ) AS r
                INNER JOIN (
                    SELECT
                     id AS vehicle_id
                    ,start_at
                    ,end_at
                    ,CASE WHEN total_days = 0 THEN 1 ELSE total_days END AS total_days_in_service
                    FROM (
                        SELECT
                         id
                        ,COALESCE(GREATEST( :from ,purchased_date), :from ,purchased_date) AS start_at
                        ,COALESCE(LEAST(:to ,sold_date), :to ,sold_date) AS end_at
                        ,DATEDIFF(
                            COALESCE(LEAST(:to,sold_date), :to,sold_date),
                            COALESCE(GREATEST(:from ,purchased_date), :from ,purchased_date)
                        ) AS total_days
                        FROM vehicles

                    ) AS ssv
                ) AS sv ON sv.vehicle_id = r.vehicle_id
                INNER JOIN vehicles AS v ON v.id = sv.vehicle_id
                WHERE r.reserved_from BETWEEN :from AND :to AND r.status IN(\'in-progress\',\'completed\')
                GROUP BY v.name
                ORDER BY v.name';

        $records = DB::select($query, ['from' => carbonFromDate($from), 'to' => carbonFromDate($to)]);

        return view('reports.vehicle_usage', compact('records', 'from', 'to'));
    }

    public function maintenance()
    {
        $vehicles = Vehicle::pluck('name', 'id')->all();

        return view('reports.maintenance', compact('vehicles'));
    }

    public function showMaintenance(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $vehicleId = $request->get('vehicle_id');

        $startAt = carbonFromDate($from);
        $endAt = carbonFromDate($to);

        $vehicles = Vehicle::pluck('name', 'id')->all();

        $expenseRecords = Expense::whereNull('expenses.deleted_at')
            ->join('expense_categories', 'expense_categories.id', '=', 'expenses.category_id')
            ->select('expense_categories.name', DB::raw('SUM(expenses.amount) AS cost'))
            ->groupBy('expense_categories.name')
            ->orderBy('expense_categories.name')
            ->whereBetween('expenses.related_date', [$startAt, $endAt])
            ->get();

        $maintenanceRecords = MaintenanceRecord::with('category', 'vehicle')
            ->whereBetween('paid_at', [$startAt, $endAt])
            ->whereNull('deleted_at')
            ->get();

        return view('reports.maintenance', compact('vehicles', 'expenseRecords', 'maintenanceRecords', 'vehicleId', 'from', 'to'));
    }

    public function revenueAndExprenses()
    {
        return view('reports.revenue_and_exprenses');
    }

    public function showRevenueAndExprenses(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $startAt = carbonFromDate($from);
        $endAt = carbonFromDate($to);

        $expenseRecords = Expense::whereNull('expenses.deleted_at')
            ->join('expense_categories', 'expense_categories.id', '=', 'expenses.category_id')
            ->select('expense_categories.name', DB::raw('SUM(expenses.amount) AS cost'))
            ->groupBy('expense_categories.name')
            ->orderBy('expense_categories.name')
            ->whereBetween('expenses.related_date', [$startAt, $endAt])
            ->get();

        $vehicles = Vehicle::join('reservations', 'reservations.vehicle_id', '=', 'vehicles.id')
            ->leftJoin('maintenance_records', 'maintenance_records.vehicle_id', '=', 'vehicles.id')
            ->Select('vehicles.name', DB::raw('SUM(maintenance_records.cost) AS cost'), DB::raw('SUM(reservations.total_rent) AS total_income'))
            ->whereNull('reservations.deleted_at')
            ->whereBetween('reservations.reserved_from', [$startAt, $endAt])
            ->where('reservations.status', '<>', 'scheduled')
            ->whereNull('maintenance_records.deleted_at')
            ->whereBetween('maintenance_records.paid_at', [$startAt, $endAt])
            ->groupBy('vehicles.name')
            ->orderBy('vehicles.name')
            ->get();

        return view('reports.revenue_and_exprenses', compact('expenseRecords', 'vehicles', 'from', 'to'));
    }

    public function cashFlow()
    {
        return view('reports.cash_flow');
    }

    public function showCashFlow(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $startAt = carbonFromDate($from);
        $endAt = carbonFromDate($to);

        $payments = Reservation::whereNull('deleted_at')
            ->whereBetween('reserved_from', [$startAt, $endAt])
            ->where('status', '<>', 'scheduled')
            ->select(DB::raw('SUM(total_paid_in_cash) AS total_paid_in_cash'))
            ->select(DB::raw('SUM(total_paid_in_bank_card) AS total_paid_in_bank_card'))
            ->first();
        $totalCash = $payments['total_paid_in_cash'] ?? 0;
        $totalCards = $payments['total_paid_in_bank_card'] ?? 0;

        $totalCredits = Credit::whereNull('deleted_at')
            ->sum('amount');

        $totalMaintenances = MaintenanceRecord::whereNull('deleted_at')
            ->whereBetween('paid_at', [$startAt, $endAt])
            ->sum('cost');

        $totalExpenses = Expense::whereNull('expenses.deleted_at')
            ->whereBetween('pay_date', [$startAt, $endAt])
            ->sum('amount');

        return view('reports.cash_flow', compact('totalCash', 'totalCards', 'totalCredits', 'totalMaintenances', 'totalExpenses', 'from', 'to'));
    }

    public function profitLossByVehicle()
    {
        return view('reports.profit_loss_by_vehicle');
    }

    public function showProfitLossByVehicle(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $startAt = carbonFromDate($from);
        $endAt = carbonFromDate($to);

        $vehicles = Vehicle::join('reservations', 'reservations.vehicle_id', '=', 'vehicles.id')
            ->leftJoin('maintenance_records', 'maintenance_records.vehicle_id', '=', 'vehicles.id')
            ->Select('vehicles.name', DB::raw('SUM(maintenance_records.cost) AS cost'), DB::raw('SUM(reservations.total_rent) AS total_income'))
            ->whereNull('reservations.deleted_at')
            ->whereBetween('reservations.reserved_from', [$startAt, $endAt])
            ->where('reservations.status', '<>', 'scheduled')
            ->whereNull('maintenance_records.deleted_at')
            ->whereBetween('maintenance_records.paid_at', [$startAt, $endAt])
            ->groupBy('vehicles.name')
            ->orderBy('vehicles.name')
            ->get();

        return view('reports.profit_loss_by_vehicle', compact('expenseRecords', 'vehicles', 'from', 'to'));
    }

    public function costAnalysis()
    {
        return view('reports.cost_analysis');
    }

    public function showCostAnalysis(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $query = 'SELECT
                 v.name
                ,AVG(r.average_daily_rent) AS average_price
                ,MAX(sv.total_days_in_service) AS total_days_in_service
                ,SUM(r.total_days) AS total_days_rented
                ,SUM(r.total_days * r.average_daily_rent) AS total_income
                ,SUM(m.cost) AS maintenance_cost
                FROM (
                    SELECT
                     id
                    ,vehicle_id
                    ,status
                    ,reserved_from
                    ,reserved_to
                    ,CASE WHEN DATEDIFF(reserved_to, reserved_from) > 0 THEN DATEDIFF(reserved_to, reserved_from) ELSE 1 END AS total_days
                    ,average_daily_rent
                    FROM (
                         SELECT
                          id
                         ,vehicle_id
                         ,status
                         ,GREATEST( :from ,reserved_from) AS reserved_from
                         ,LEAST( :to ,reserved_to) AS reserved_to
                         ,total_rent/total_days AS average_daily_rent
                         FROM reservations
                         WHERE deleted_at IS NULL
                     ) AS sr
                ) AS r
                INNER JOIN (
                    SELECT
                     id AS vehicle_id
                    ,start_at
                    ,end_at
                    ,CASE WHEN total_days = 0 THEN 1 ELSE total_days END AS total_days_in_service
                    FROM (
                        SELECT
                         id
                        ,COALESCE(GREATEST( :from ,purchased_date), :from ,purchased_date) AS start_at
                        ,COALESCE(LEAST(:to ,sold_date), :to ,sold_date) AS end_at
                        ,DATEDIFF(
                            COALESCE(LEAST(:to,sold_date), :to,sold_date),
                            COALESCE(GREATEST(:from ,purchased_date), :from ,purchased_date)
                        ) AS total_days
                        FROM vehicles

                    ) AS ssv
                ) AS sv ON sv.vehicle_id = r.vehicle_id
                INNER JOIN vehicles AS v ON v.id = sv.vehicle_id
                LEFT JOIN maintenance_records AS m ON m.vehicle_id = v.id AND m.deleted_at IS NULL
                WHERE r.reserved_from BETWEEN :from AND :to AND r.status IN(\'in-progress\',\'completed\')
                GROUP BY v.name
                ORDER BY v.name';

        $startAt = carbonFromDate($from);
        $endAt = carbonFromDate($to);

        $records = DB::select($query, ['from' => $startAt, 'to' => $endAt]);

        $totalMaintenances = MaintenanceRecord::whereNull('deleted_at')
            ->whereBetween('paid_at', [$startAt, $endAt])
            ->sum('cost');

        $operatingCostPerVehicle = $totalMaintenances / count($records);

        return view('reports.cost_analysis', compact('records', 'operatingCostPerVehicle', 'from', 'to'));
    }
}
