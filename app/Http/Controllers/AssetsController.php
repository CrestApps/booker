<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetsFormRequest;
use App\Models\Asset;
use App\Models\AssetCategory;
use Exception;

class AssetsController extends Controller
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
     * Display a listing of the assets.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $assets = Asset::with('category')->paginate(25);

        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new asset.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $categories = AssetCategory::pluck('name', 'id')->all();

        return view('assets.create', compact('categories'));
    }

    /**
     * Store a new asset in the storage.
     *
     * @param App\Http\Requests\AssetsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AssetsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Asset::create($data);

            return redirect()->route('assets.asset.index')
                ->with('success_message', trans('assets.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('assets.unexpected_error')]);
        }
    }

    /**
     * Display the specified asset.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $asset = Asset::with('category')->findOrFail($id);

        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified asset.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $categories = AssetCategory::pluck('name', 'id')->all();

        return view('assets.edit', compact('asset', 'categories'));
    }

    /**
     * Update the specified asset in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AssetsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AssetsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $asset = Asset::findOrFail($id);
            $asset->update($data);

            return redirect()->route('assets.asset.index')
                ->with('success_message', trans('assets.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('assets.unexpected_error')]);
        }
    }

    /**
     * Remove the specified asset from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $asset = Asset::findOrFail($id);
            $asset->delete();

            return redirect()->route('assets.asset.index')
                ->with('success_message', trans('assets.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('assets.unexpected_error')]);
        }
    }
}
