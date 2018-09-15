<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditPaymentsFormRequest;
use App\Models\Credit;
use App\Models\CreditPayment;
use Exception;

class CreditPaymentsController extends Controller
{

    /**
     * Display a listing of the credit payments.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $creditPayments = CreditPayment::with('credit')->paginate(25);

        return view('credit_payments.index', compact('creditPayments'));
    }

    /**
     * Show the form for creating a new credit payment.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $credits = Credit::pluck('id','id')->all();
        
        return view('credit_payments.create', compact('credits'));
    }

    /**
     * Store a new credit payment in the storage.
     *
     * @param App\Http\Requests\CreditPaymentsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CreditPaymentsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            CreditPayment::create($data);

            return redirect()->route('credit_payments.credit_payment.index')
                ->with('success_message', trans('credit_payments.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('credit_payments.unexpected_error')]);
        }
    }

    /**
     * Display the specified credit payment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $creditPayment = CreditPayment::with('credit')->findOrFail($id);

        return view('credit_payments.show', compact('creditPayment'));
    }

    /**
     * Show the form for editing the specified credit payment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $creditPayment = CreditPayment::findOrFail($id);
        $credits = Credit::pluck('id','id')->all();

        return view('credit_payments.edit', compact('creditPayment','credits'));
    }

    /**
     * Update the specified credit payment in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\CreditPaymentsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CreditPaymentsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $creditPayment = CreditPayment::findOrFail($id);
            $creditPayment->update($data);

            return redirect()->route('credit_payments.credit_payment.index')
                ->with('success_message', trans('credit_payments.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('credit_payments.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified credit payment from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $creditPayment = CreditPayment::findOrFail($id);
            $creditPayment->delete();

            return redirect()->route('credit_payments.credit_payment.index')
                ->with('success_message', trans('credit_payments.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('credit_payments.unexpected_error')]);
        }
    }



}
