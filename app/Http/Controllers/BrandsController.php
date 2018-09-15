<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandsFormRequest;
use App\Models\Brand;
use Exception;

class BrandsController extends Controller
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
     * Display a listing of the brands.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $brands = Brand::paginate(25);

        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        return view('brands.create');
    }

    /**
     * Store a new brand in the storage.
     *
     * @param App\Http\Requests\BrandsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BrandsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Brand::create($data);

            return redirect()->route('brands.brand.index')
                ->with('success_message', trans('brands.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('brands.unexpected_error')]);
        }
    }

    /**
     * Display the specified brand.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        return view('brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified brand.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\BrandsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BrandsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $brand = Brand::findOrFail($id);
            $brand->update($data);

            return redirect()->route('brands.brand.index')
                ->with('success_message', trans('brands.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('brands.unexpected_error')]);
        }
    }

    /**
     * Remove the specified brand from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();

            return redirect()->route('brands.brand.index')
                ->with('success_message', trans('brands.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('brands.unexpected_error')]);
        }
    }
}
