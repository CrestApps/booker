<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRecordsFormRequest;
use App\Models\MaintenanceCatgeory;
use App\Models\MaintenanceRecord;
use App\Models\Vehicle;
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
        $maintenanceRecords = MaintenanceRecord::with('vehicle','catgeory')->paginate(25);

        return view('maintenance_records.index', compact('maintenanceRecords'));
    }

    /**
     * Show the form for creating a new maintenance record.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $vehicles = Vehicle::pluck('name','id')->all();
$catgeories = MaintenanceCatgeory::pluck('name','id')->all();
        
        return view('maintenance_records.create', compact('vehicles','catgeories'));
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
            
            $data = $request->getData();
            
            MaintenanceRecord::create($data);

            return redirect()->route('maintenance_records.maintenance_record.index')
                ->with('success_message', trans('maintenance_records.model_was_added'));
        } catch (Exception $exception) {

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
        $maintenanceRecord = MaintenanceRecord::with('vehicle','catgeory')->findOrFail($id);

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
        $maintenanceRecord = MaintenanceRecord::findOrFail($id);
        $vehicles = Vehicle::pluck('name','id')->all();
$catgeories = MaintenanceCatgeory::pluck('name','id')->all();

        return view('maintenance_records.edit', compact('maintenanceRecord','vehicles','catgeories'));
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
            
            $data = $request->getData();
            
            $maintenanceRecord = MaintenanceRecord::findOrFail($id);
            $maintenanceRecord->update($data);

            return redirect()->route('maintenance_records.maintenance_record.index')
                ->with('success_message', trans('maintenance_records.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('maintenance_records.unexpected_error')]);
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
