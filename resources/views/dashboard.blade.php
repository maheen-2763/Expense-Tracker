@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
 <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <!-- Total -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Total Balance</p>
        <h2 class="text-2xl font-bold text-gray-800">₹ {{ number_format($balance ?? 0) }}</h2>
    </div>

    <!-- Income -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Total Income</p>
        <h2 class="text-2xl font-bold text-gray-800">₹ {{ number_format($totalIncome ?? 0) }}</h2>
    </div>

    <!-- Expense -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Total Expense</p>
        <h2 class="text-2xl font-bold text-red-600">₹ {{ number_format($totalExpense ?? 0) }}</h2>
    </div>

</div>
@endsection