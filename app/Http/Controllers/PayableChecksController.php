<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayableChecksFormRequest;
use App\Models\Expense;
use App\Models\PayableCheck;
use Exception;

class PayableChecksController extends Controller
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
     * Display a listing of the payable checks.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $payableChecks = PayableCheck::paginate(25);

        return view('payable_checks.index', compact('payableChecks'));
    }

    /**
     * Show the form for creating a new payable check.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $expenses = Expense::pluck('id', 'id')->all();

        return view('payable_checks.create', compact('expenses'));
    }

    /**
     * Store a new payable check in the storage.
     *
     * @param App\Http\Requests\PayableChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PayableChecksFormRequest $request)
    {
        try {

            $data = $request->getData();

            PayableCheck::create($data);

            return redirect()->route('payable_checks.payable_check.index')
                ->with('success_message', trans('payable_checks.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('payable_checks.unexpected_error')]);
        }
    }

    /**
     * Display the specified payable check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $payableCheck = PayableCheck::with('expense')->findOrFail($id);

        return view('payable_checks.show', compact('payableCheck'));
    }

    /**
     * Show the form for editing the specified payable check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $payableCheck = PayableCheck::findOrFail($id);
        $expenses = Expense::pluck('id', 'id')->all();

        return view('payable_checks.edit', compact('payableCheck', 'expenses'));
    }

    /**
     * Update the specified payable check in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\PayableChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PayableChecksFormRequest $request)
    {
        try {
            $data = $request->getData();

            $payableCheck = PayableCheck::findOrFail($id);
            $payableCheck->update($data);

            return redirect()->route('payable_checks.payable_check.index')
                ->with('success_message', trans('payable_checks.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('payable_checks.unexpected_error')]);
        }
    }

    /**
     * Remove the specified payable check from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $payableCheck = PayableCheck::findOrFail($id);
            $payableCheck->delete();

            return redirect()->route('payable_checks.payable_check.index')
                ->with('success_message', trans('payable_checks.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('payable_checks.unexpected_error')]);
        }
    }

}
