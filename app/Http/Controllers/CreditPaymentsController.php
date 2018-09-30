<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditPaymentsFormRequest;
use App\Http\Resources\GenericJsonResource;
use App\Models\Check;
use App\Models\Credit;
use App\Models\CreditPayment;
use DB;
use Exception;

class CreditPaymentsController extends Controller
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
     * Display a listing of the credit payments.
     *
     * @return Illuminate\View\View
     */
    /*
    public function index()
    {
    $creditPayments = CreditPayment::with('credit', 'check')->paginate(25);

    return view('credit_payments.index', compact('creditPayments'));
    }
     */
    /**
     * Show the form for creating a new credit payment.
     *
     * @return Illuminate\View\View
     */
    /*
    public function create()
    {
    $credits = Credit::pluck('id', 'id')->all();
    $checks = Check::pluck('created_at', 'id')->all();

    return view('credit_payments.create', compact('credits', 'checks'));
    }
     */
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

            $data = $request->validated();

            DB::transaction(function () use ($data) {
                $credit = Credit::findOrFail($data['credit_id']);

                if ($data['amount'] > $credit->amount) {
                    throw new Exception('The payment amount is more than the amount owed.');
                }

                $checkId = null;
                if ($data['payment_method'] == 'check') {
                    // create a check if one is provided
                    $check = Check::whipOut(null, $credit->customer_id, $data['amount'], $data['due_date']);
                    $check->save();

                    $checkId = $check->id;
                }

                // create payment
                $payment = CreditPayment::whipOut($credit->id, $data['amount'], $data['payment_method'], $checkId);
                $payment->save();

                // update the remaining balance
                $credit->amount -= $data['amount'];
                $credit->save();
            });

            return new GenericJsonResource(trans('credit_payments.model_was_added'));

        } catch (Exception $exception) {

            return new GenericJsonResource($exception->getMessage(), false);
        }
    }

    /**
     * Display the specified credit payment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    /*
    public function show($id)
    {
    $creditPayment = CreditPayment::with('credit', 'check')->findOrFail($id);

    return view('credit_payments.show', compact('creditPayment'));
    }
     */
    /**
     * Show the form for editing the specified credit payment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    /*
    public function edit($id)
    {
    $creditPayment = CreditPayment::findOrFail($id);
    $credits = Credit::pluck('id', 'id')->all();
    $checks = Check::pluck('created_at', 'id')->all();

    return view('credit_payments.edit', compact('creditPayment', 'credits', 'checks'));
    }
     */

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

            $data = $request->validated();
            $payment = CreditPayment::findOrFail($id);
            DB::transaction(function () use ($payment) {
                // find out the amount delta
                // +- from the credit->amount
                // +- from the payment->amount
                $delta = $data['amount'] - $payment->amount;

                if ($payment->credit->amount + $delta < 0) {
                    throw new Exception('The payment amount is more than the amount owed');
                }

                $payment->credit->amount += $delta;
                $payment->credit->save();
                $payment->amount += $delta;
                $payment->payment_method = $data['payment_method'];
                $payment->save();
            });

            return new GenericJsonResource(trans('credit_payments.model_was_updated'));

        } catch (Exception $exception) {
            return new GenericJsonResource($exception->getMessage(), false);
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
        $payment = CreditPayment::findOrFail($id);

        DB::transaction(function () use ($payment) {
            $payment->credit->amount += $payment->amount;
            $payment->credit->save();
            $payment->delete();
        });

        return redirect()->route('credits.credit.show', ['id' => $payment->credit_id])
            ->with('success_message', trans('credit_payments.model_was_deleted'));
    }

}
