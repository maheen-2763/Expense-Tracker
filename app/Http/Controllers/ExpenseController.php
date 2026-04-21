<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseStoreRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Models\User;

class ExpenseController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        if (Auth::user()->role === User::ROLE_ADMIN) {
            $expenses = Expense::latest()->paginate(10);
        } else {
        $expenses = Expense::owned()
            ->latest()
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
        }
    }

    public function create()
    {
        $this->authorize('create', Expense::class);

        return view('expenses.create');
    }

    public function store(ExpenseStoreRequest $request)
    {
        $this->authorize('create', Expense::class);

        $validated = $request->validated();

        Expense::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);

        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense); // 🔥 FIX

        return view('expenses.edit', compact('expense'));
    }

    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $validated = $request->validated();

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
