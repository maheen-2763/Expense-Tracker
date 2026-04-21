<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function display()
    {
        $userId = Auth::id();

        $totalIncome = Expense::where('user_id', $userId)->where('type', 'income')->sum('amount');
        $totalExpense = Expense::where('user_id', $userId)->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('dashboard', compact('totalIncome', 'totalExpense', 'balance'));
    }
}
