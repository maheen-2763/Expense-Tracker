<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function display()
{
    $query = Expense::owned(); // QUERY BUILDER

    $totalTransactions = $query->count();

    // Basic Stats (DB level)
    $income = $query->clone()->where('type', 'income')->sum('amount');
    $expense = $query->clone()->where('type', 'expense')->sum('amount');
    $balance = $income - $expense;


        // Monthly Breakdown (DB level)
    $monthlyIncome = (clone $query)
    ->where('type', 'income')
    ->selectRaw('CAST(strftime("%m", date) AS INTEGER) as month, SUM(amount) as total')
    ->groupBy('month')
    ->pluck('total', 'month');

    $monthlyExpense = (clone $query)
    ->where('type', 'expense')
    ->selectRaw('CAST(strftime("%m", date) AS INTEGER) as month, SUM(amount) as total')
    ->groupBy('month')
    ->pluck('total', 'month');

        // Recent Transactions
    $recent = $query->clone()
        ->latest()
        ->take(5)
        ->get();


    return view('dashboard', compact(
        'totalTransactions',
        'income',
        'expense',
        'balance',
        'monthlyIncome',
        'monthlyExpense',
        'recent'
    ));
}
}
