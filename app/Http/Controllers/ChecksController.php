<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChecksFormRequest;
use App\Models\Check;
use App\Models\Customer;
use Exception;

class ChecksController extends Controller
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
     * Display a listing of the checks.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $checks = Check::with('customer')->paginate(25);

        return view('checks.index', compact('checks'));
    }

    /**
     * Display the specified check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $check = Check::with('customer')->findOrFail($id);

        return view('checks.show', compact('check'));
    }

    /**
     * Show the form for editing the specified check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $check = Check::findOrFail($id);
        $customers = Customer::pluck('fullname', 'id')->all();

        return view('checks.edit', compact('check', 'customers'));
    }

    /**
     * Update the specified check in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ChecksFormRequest $request)
    {
        try {
            $data = $request->getData();

            $check = Check::findOrFail($id);
            $check->update($data);

            return redirect()->route('checks.check.index')
                ->with('success_message', trans('checks.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('checks.unexpected_error')]);
        }
    }

    /**
     * Remove the specified check from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $check = Check::findOrFail($id);
            $check->delete();

            return redirect()->route('checks.check.index')
                ->with('success_message', trans('checks.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('checks.unexpected_error')]);
        }
    }

}
