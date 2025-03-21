<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Expense::create([
            'value' => $validated['value'],
            'salary_id' => $validated['salary_id'],
            'category_id' => $validated['category_id']
        ]);

        return to_route('salaries.show', $validated['salary_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense): Response
    {
        return Inertia::render('expense/Show', [
            'expense' => $expense
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $validated = $request->validated();

        $expense->value = $validated['value'];

        $expense->update();

        return to_route('expenses.show', $expense->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        $expense->delete();

        return to_route('salaries.show', $expense->salary_id);
    }
}
