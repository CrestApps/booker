<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceCategoriesFormRequest;
use App\Models\MaintenanceCategory;
use Exception;

class MaintenanceCategoriesController extends Controller
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
     * Display a listing of the maintenance categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $maintenanceCategories = MaintenanceCategory::paginate(25);

        return view('maintenance_categories.index', compact('maintenanceCategories'));
    }

    /**
     * Show the form for creating a new maintenance category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('maintenance_categories.create');
    }

    /**
     * Store a new maintenance category in the storage.
     *
     * @param App\Http\Requests\MaintenanceCategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MaintenanceCategoriesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            MaintenanceCategory::create($data);

            return redirect()->route('maintenance_categories.maintenance_category.index')
                ->with('success_message', trans('maintenance_categories.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('maintenance_categories.unexpected_error')]);
        }
    }

    /**
     * Display the specified maintenance category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $maintenanceCategory = MaintenanceCategory::findOrFail($id);

        return view('maintenance_categories.show', compact('maintenanceCategory'));
    }

    /**
     * Show the form for editing the specified maintenance category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $maintenanceCategory = MaintenanceCategory::findOrFail($id);
        

        return view('maintenance_categories.edit', compact('maintenanceCategory'));
    }

    /**
     * Update the specified maintenance category in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\MaintenanceCategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MaintenanceCategoriesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $maintenanceCategory = MaintenanceCategory::findOrFail($id);
            $maintenanceCategory->update($data);

            return redirect()->route('maintenance_categories.maintenance_category.index')
                ->with('success_message', trans('maintenance_categories.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('maintenance_categories.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified maintenance category from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $maintenanceCategory = MaintenanceCategory::findOrFail($id);
            $maintenanceCategory->delete();

            return redirect()->route('maintenance_categories.maintenance_category.index')
                ->with('success_message', trans('maintenance_categories.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('maintenance_categories.unexpected_error')]);
        }
    }



}
