<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomersFormRequest;
use App\Models\Customer;
use Exception;

class CustomersController extends Controller
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
     * Display a listing of the customers.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $customers = Customer::paginate(25);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('customers.create');
    }

    /**
     * Store a new customer in the storage.
     *
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Customer::create($data);

            return redirect()->route('customers.customer.index')
                ->with('success_message', trans('customers.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }
    }

    /**
     * Display the specified customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $customer = Customer::findOrFail($id);
            $customer->update($data);

            return redirect()->route('customers.customer.index')
                ->with('success_message', trans('customers.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified customer from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect()->route('customers.customer.index')
                ->with('success_message', trans('customers.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }
    }



}
