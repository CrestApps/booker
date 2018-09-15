<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditsFormRequest;
use App\Models\Credit;
use App\Models\Customer;
use Exception;

class CreditsController extends Controller
{

    /**
     * Display a listing of the credits.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $credits = Credit::with('customer')->paginate(25);

        return view('credits.index', compact('credits'));
    }

    /**
     * Show the form for creating a new credit.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::pluck('fullname','id')->all();
        
        return view('credits.create', compact('customers'));
    }

    /**
     * Store a new credit in the storage.
     *
     * @param App\Http\Requests\CreditsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CreditsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Credit::create($data);

            return redirect()->route('credits.credit.index')
                ->with('success_message', trans('credits.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('credits.unexpected_error')]);
        }
    }

    /**
     * Display the specified credit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $credit = Credit::with('customer')->findOrFail($id);

        return view('credits.show', compact('credit'));
    }

    /**
     * Show the form for editing the specified credit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $credit = Credit::findOrFail($id);
        $customers = Customer::pluck('fullname','id')->all();

        return view('credits.edit', compact('credit','customers'));
    }

    /**
     * Update the specified credit in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\CreditsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CreditsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $credit = Credit::findOrFail($id);
            $credit->update($data);

            return redirect()->route('credits.credit.index')
                ->with('success_message', trans('credits.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('credits.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified credit from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $credit = Credit::findOrFail($id);
            $credit->delete();

            return redirect()->route('credits.credit.index')
                ->with('success_message', trans('credits.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('credits.unexpected_error')]);
        }
    }



}
