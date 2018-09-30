<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRecordsFormRequest;
use App\Models\MaintenanceCategory;
use App\Models\MaintenanceRecord;
use App\Models\PayableCheck;
use App\Models\Vehicle;
use Carbon\Carbon;
use DB;
use Exception;

class MaintenanceRecordsController extends Controller
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

    /**
     * Display a listing of the maintenance records.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $maintenanceRecords = MaintenanceRecord::with('vehicle', 'category')->paginate(25);

        return view('maintenance_records.index', compact('maintenanceRecords'));
    }

    /**
     * Show the form for creating a new maintenance record.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $vehicles = Vehicle::pluck('name', 'id')->all();
        $catgeories = MaintenanceCategory::pluck('name', 'id')->all();

        return view('maintenance_records.create', compact('vehicles', 'catgeories'));
    }

    /**
     * Store a new maintenance record in the storage.
     *
     * @param App\Http\Requests\MaintenanceRecordsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MaintenanceRecordsFormRequest $request)
    {
        try {
            $data = $request->validated();

            DB::transaction(function () use ($data) {
                $record = MaintenanceRecord::whipOut($data['vehicle_id'],
                    $data['category_id'],
                    $data['payment_method'],
                    $data['cost'],
                    $data['paid_at'],
                    $data['related_date'],
                    $data['notes']);

                $record->save();

                if ($data['payment_method'] == 'checks') {
                    foreach ($data['checks'] as $check) {
                        $checkData = array_replace($check, [
                            'expense_id' => $record->id,
                            'issue_date' => $record->paid_at,
                        ]);

                        $payableCheck = PayableCheck::whipOut($check['number'],
                            $check['value'],
                            $check['due_date'],
                            $data['paid_at'],
                            $record->id);
                        $payableCheck->save();
                    }
                }
            });

            return redirect()->route('maintenance_records.maintenance_record.index')
                ->with('success_message', trans('maintenance_records.model_was_added'));
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('maintenance_records.unexpected_error')]);
        }
    }

    /**
     * Display the specified maintenance record.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $maintenanceRecord = MaintenanceRecord::with('vehicle', 'category')->findOrFail($id);

        return view('maintenance_records.show', compact('maintenanceRecord'));
    }

    /**
     * Show the form for editing the specified maintenance record.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $maintenanceRecord = MaintenanceRecord::with('payableChecks')->findOrFail($id);

        $vehicles = Vehicle::pluck('name', 'id')->all();
        $catgeories = MaintenanceCategory::pluck('name', 'id')->all();

        return view('maintenance_records.edit', compact('maintenanceRecord', 'vehicles', 'catgeories'));
    }

    /**
     * Update the specified maintenance record in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\MaintenanceRecordsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MaintenanceRecordsFormRequest $request)
    {
        try {
            $data = $request->validated();

            DB::transaction(function () use ($id, $data) {

                $record = MaintenanceRecord::findOrFail($id);

                $record->vehicle_id = $data['vehicle_id'];
                $record->category_id = $data['category_id'];
                $record->payment_method = $data['payment_method'];
                $record->cost = $data['cost'];
                $record->paid_at = $data['paid_at'];
                $record->related_date = $data['related_date'];
                $record->notes = $data['notes'];
                $record->save();

                if ($data['payment_method'] == 'checks') {
                    foreach ($data['checks'] as $check) {
                        $checkData = array_replace($check, [
                            'expense_id' => $record->id,
                            'issue_date' => $record->paid_at,
                            'due_date' => Carbon::createFromFormat(config('app.date_out_format'), $check['due_date']),
                        ]);

                        PayableCheck::updateOrCreate(['id' => $check['id']], $checkData);
                    }
                }
            });

            return redirect()->route('maintenance_records.maintenance_record.index')
                ->with('success_message', trans('maintenance_records.model_was_updated'));
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage() . trans('maintenance_records.unexpected_error')]);
        }
    }

    /**
     * Remove the specified maintenance record from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $maintenanceRecord = MaintenanceRecord::findOrFail($id);
            $maintenanceRecord->delete();

            return redirect()->route('maintenance_records.maintenance_record.index')
                ->with('success_message', trans('maintenance_records.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('maintenance_records.unexpected_error')]);
        }
    }

}
