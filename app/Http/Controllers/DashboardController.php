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

    // Basic Stats (DB level)
    $income = $query->clone()->where('type', 'income')->sum('amount');
    $expense = $query->clone()->where('type', 'expense')->sum('amount');
    $balance = $income - $expense;

    // Monthly Data (IMPORTANT FIX)
    $monthly = $query->clone()
        ->selectRaw("strftime('%m', date) as month, SUM(amount) as total")
        ->where('type', 'expense')
        ->groupBy('month')
        ->pluck('total', 'month');

    // Recent Transactions
    $recent = $query->clone()
        ->latest()
        ->take(5)
        ->get();

    // Top Category (FIXED)
    

    return view('dashboard', compact(
        'income',
        'expense',
        'balance',
        'monthly',
        'recent',
    ));
}
}
