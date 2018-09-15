<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseCategoriesFormRequest;
use App\Models\ExpenseCategory;
use Exception;

class ExpenseCategoriesController extends Controller
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
     * Display a listing of the expense categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::paginate(25);

        return view('expense_categories.index', compact('expenseCategories'));
    }

    /**
     * Show the form for creating a new expense category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('expense_categories.create');
    }

    /**
     * Store a new expense category in the storage.
     *
     * @param App\Http\Requests\ExpenseCategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ExpenseCategoriesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            ExpenseCategory::create($data);

            return redirect()->route('expense_categories.expense_category.index')
                ->with('success_message', trans('expense_categories.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('expense_categories.unexpected_error')]);
        }
    }

    /**
     * Display the specified expense category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);

        return view('expense_categories.show', compact('expenseCategory'));
    }

    /**
     * Show the form for editing the specified expense category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        

        return view('expense_categories.edit', compact('expenseCategory'));
    }

    /**
     * Update the specified expense category in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ExpenseCategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ExpenseCategoriesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $expenseCategory = ExpenseCategory::findOrFail($id);
            $expenseCategory->update($data);

            return redirect()->route('expense_categories.expense_category.index')
                ->with('success_message', trans('expense_categories.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('expense_categories.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified expense category from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $expenseCategory = ExpenseCategory::findOrFail($id);
            $expenseCategory->delete();

            return redirect()->route('expense_categories.expense_category.index')
                ->with('success_message', trans('expense_categories.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('expense_categories.unexpected_error')]);
        }
    }



}
