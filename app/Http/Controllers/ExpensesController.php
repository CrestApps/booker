<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesFormRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Exception;

class ExpensesController extends Controller
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
     * Display a listing of the expenses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $expenses = Expense::with('category')->paginate(25);

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new expense.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $categories = ExpenseCategory::pluck('name','id')->all();
        
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a new expense in the storage.
     *
     * @param App\Http\Requests\ExpensesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ExpensesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Expense::create($data);

            return redirect()->route('expenses.expense.index')
                ->with('success_message', trans('expenses.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('expenses.unexpected_error')]);
        }
    }

    /**
     * Display the specified expense.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $expense = Expense::with('category')->findOrFail($id);

        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified expense.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $categories = ExpenseCategory::pluck('name','id')->all();

        return view('expenses.edit', compact('expense','categories'));
    }

    /**
     * Update the specified expense in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ExpensesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ExpensesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $expense = Expense::findOrFail($id);
            $expense->update($data);

            return redirect()->route('expenses.expense.index')
                ->with('success_message', trans('expenses.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('expenses.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified expense from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();

            return redirect()->route('expenses.expense.index')
                ->with('success_message', trans('expenses.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('expenses.unexpected_error')]);
        }
    }



}
