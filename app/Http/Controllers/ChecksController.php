<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChecksFormRequest;
use App\Models\Check;
use App\Models\Customer;
use App\Models\Reservation;
use Exception;

class ChecksController extends Controller
{

    /**
     * Display a listing of the checks.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $checks = Check::with('customer','reservation')->paginate(25);

        return view('checks.index', compact('checks'));
    }

    /**
     * Show the form for creating a new check.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::pluck('fullname','id')->all();
$reservations = Reservation::pluck('created_at','id')->all();
        
        return view('checks.create', compact('customers','reservations'));
    }

    /**
     * Store a new check in the storage.
     *
     * @param App\Http\Requests\ChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ChecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Check::create($data);

            return redirect()->route('checks.check.index')
                ->with('success_message', trans('checks.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('checks.unexpected_error')]);
        }
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
        $check = Check::with('customer','reservation')->findOrFail($id);

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
        $customers = Customer::pluck('fullname','id')->all();
$reservations = Reservation::pluck('created_at','id')->all();

        return view('checks.edit', compact('check','customers','reservations'));
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
