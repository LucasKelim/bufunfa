<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Salary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $search = request()->all()['search'] ?? '';
        $salaries = Salary::where('value', 'LIKE', "$search%")
            ->orderByDesc('id')
            ->with('user')
            ->paginate(6)
            ->onEachSide(0)
            ->withQueryString();

        return Inertia::render('salary/Index', [
            'salaries' => $salaries,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('salary/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Salary::create([
            'value' => $validated['value'],
            'user_id' => $validated['user_id']
        ]);

        return to_route('salaries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary): Response
    {
        $expenses = Expense::where('salary_id', $salary->id)
            ->orderByDesc('id')
            ->with('category')
            ->paginate(6)
            ->withQueryString();

        $categories = Category::all();

        return Inertia::render('salary/Show', [
            'salary' => $salary,
            'expenses' => $expenses,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaryRequest $request, Salary $salary): RedirectResponse
    {
        $validated = $request->validated();

        $salary->value = $validated['value'];

        $salary->update();

        return to_route('salaries.show', $salary->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary): RedirectResponse
    {
        $salary->delete();

        return to_route('salaries.index');
    }
}
