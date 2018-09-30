<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CreditsController extends Controller
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
     * Display a listing of the credits.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $term = $request->get('term');

        $credits = Credit::with('customer')->whereHas('customer', function ($query) use ($term) {
            $query->search($term);
        })->paginate(25);

        return view('credits.index', compact('credits', 'term'));
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
        $credit = Credit::with('customer', 'reservationRelations', 'payments')->findOrFail($id);

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
        $customers = Customer::pluck('fullname', 'id')->all();

        return view('credits.edit', compact('credit', 'customers'));
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
