<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetCategoriesFormRequest;
use App\Models\AssetCategory;
use Exception;

class AssetCategoriesController extends Controller
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
     * Display a listing of the asset categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $assetCategories = AssetCategory::paginate(25);

        return view('asset_categories.index', compact('assetCategories'));
    }

    /**
     * Show the form for creating a new asset category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        return view('asset_categories.create');
    }

    /**
     * Store a new asset category in the storage.
     *
     * @param App\Http\Requests\AssetCategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AssetCategoriesFormRequest $request)
    {
        try {

            $data = $request->getData();

            AssetCategory::create($data);

            return redirect()->route('asset_categories.asset_category.index')
                ->with('success_message', trans('asset_categories.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('asset_categories.unexpected_error')]);
        }
    }

    /**
     * Display the specified asset category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $assetCategory = AssetCategory::findOrFail($id);

        return view('asset_categories.show', compact('assetCategory'));
    }

    /**
     * Show the form for editing the specified asset category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $assetCategory = AssetCategory::findOrFail($id);

        return view('asset_categories.edit', compact('assetCategory'));
    }

    /**
     * Update the specified asset category in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AssetCategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AssetCategoriesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $assetCategory = AssetCategory::findOrFail($id);
            $assetCategory->update($data);

            return redirect()->route('asset_categories.asset_category.index')
                ->with('success_message', trans('asset_categories.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('asset_categories.unexpected_error')]);
        }
    }

    /**
     * Remove the specified asset category from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $assetCategory = AssetCategory::findOrFail($id);
            $assetCategory->delete();

            return redirect()->route('asset_categories.asset_category.index')
                ->with('success_message', trans('asset_categories.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('asset_categories.unexpected_error')]);
        }
    }
}
