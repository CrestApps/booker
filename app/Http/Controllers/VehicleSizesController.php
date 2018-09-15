<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleSizesFormRequest;
use App\Models\VehicleSize;
use Exception;

class VehicleSizesController extends Controller
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
     * Display a listing of the vehicle sizes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $vehicleSizes = VehicleSize::paginate(25);

        return view('vehicle_sizes.index', compact('vehicleSizes'));
    }

    /**
     * Show the form for creating a new vehicle size.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('vehicle_sizes.create');
    }

    /**
     * Store a new vehicle size in the storage.
     *
     * @param App\Http\Requests\VehicleSizesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(VehicleSizesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            VehicleSize::create($data);

            return redirect()->route('vehicle_sizes.vehicle_size.index')
                ->with('success_message', trans('vehicle_sizes.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('vehicle_sizes.unexpected_error')]);
        }
    }

    /**
     * Display the specified vehicle size.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $vehicleSize = VehicleSize::findOrFail($id);

        return view('vehicle_sizes.show', compact('vehicleSize'));
    }

    /**
     * Show the form for editing the specified vehicle size.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $vehicleSize = VehicleSize::findOrFail($id);
        

        return view('vehicle_sizes.edit', compact('vehicleSize'));
    }

    /**
     * Update the specified vehicle size in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\VehicleSizesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, VehicleSizesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $vehicleSize = VehicleSize::findOrFail($id);
            $vehicleSize->update($data);

            return redirect()->route('vehicle_sizes.vehicle_size.index')
                ->with('success_message', trans('vehicle_sizes.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('vehicle_sizes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified vehicle size from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $vehicleSize = VehicleSize::findOrFail($id);
            $vehicleSize->delete();

            return redirect()->route('vehicle_sizes.vehicle_size.index')
                ->with('success_message', trans('vehicle_sizes.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('vehicle_sizes.unexpected_error')]);
        }
    }



}
