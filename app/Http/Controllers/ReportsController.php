<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Reservation;
use App\Models\Vehicle;
use DB;

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

    /*
public function assets()
{
return view('reports.assets');
}

public function showAssets()
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
 */
}
