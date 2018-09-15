<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehiclesFormRequest;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleSize;
use Exception;

class VehiclesController extends Controller
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
     * Display a listing of the vehicles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $vehicles = Vehicle::with('size','brand')->paginate(25);

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sizes = VehicleSize::pluck('name','id')->all();
$brands = Brand::pluck('name','id')->all();
        
        return view('vehicles.create', compact('sizes','brands'));
    }

    /**
     * Store a new vehicle in the storage.
     *
     * @param App\Http\Requests\VehiclesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(VehiclesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Vehicle::create($data);

            return redirect()->route('vehicles.vehicle.index')
                ->with('success_message', trans('vehicles.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('vehicles.unexpected_error')]);
        }
    }

    /**
     * Display the specified vehicle.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $vehicle = Vehicle::with('size','brand')->findOrFail($id);

        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $sizes = VehicleSize::pluck('name','id')->all();
$brands = Brand::pluck('name','id')->all();

        return view('vehicles.edit', compact('vehicle','sizes','brands'));
    }

    /**
     * Update the specified vehicle in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\VehiclesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, VehiclesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->update($data);

            return redirect()->route('vehicles.vehicle.index')
                ->with('success_message', trans('vehicles.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('vehicles.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified vehicle from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->delete();

            return redirect()->route('vehicles.vehicle.index')
                ->with('success_message', trans('vehicles.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('vehicles.unexpected_error')]);
        }
    }



}
