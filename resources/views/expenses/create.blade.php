@extends('layouts.app')

@section('title', 'Add Expense')

@section('content')

<div class="max-w-2xl mx-auto py-12 px-6">

    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
            Add Expense
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Track your income and expenses with clarity.
        </p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-8">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">
                Title
            </label>
            <input 
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="e.g. Freelance payment"
                class="w-full border-0 border-b border-gray-200 focus:border-black focus:ring-0 bg-transparent py-2 text-gray-900 placeholder-gray-400"
            >
            @error('title')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Amount -->
        <div>
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">
                Amount
            </label>
            <input 
                type="number"
                name="amount"
                value="{{ old('amount') }}"
                placeholder="0"
                class="w-full border-0 border-b border-gray-200 focus:border-black focus:ring-0 bg-transparent py-2 text-gray-900 placeholder-gray-400"
            >
            @error('amount')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Type -->
        <div>
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">
                Type
            </label>
            <select 
                name="type"
                class="w-full border-0 border-b border-gray-200 focus:border-black focus:ring-0 bg-transparent py-2 text-gray-900"
            >
                <option value="">Select type</option>
                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
            </select>

            @error('type')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date -->
        <div>
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">
                Date
            </label>
            <input 
                type="date"
                name="date"
                value="{{ old('date') }}"
                class="w-full border-0 border-b border-gray-200 focus:border-black focus:ring-0 bg-transparent py-2 text-gray-900"
            >

            @error('date')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button 
                type="submit"
                class="px-5 py-2 bg-black text-white text-sm font-medium rounded-md hover:bg-gray-800 transition"
            >
                Save
            </button>
                <a href="{{ route('expenses.index') }}" class="px-5 py-2 bg-black text-white text-sm font-medium rounded-md hover:bg-gray-800 transition">
                    Back
                </a>
        </div>

    </form>

</div>

@endsection