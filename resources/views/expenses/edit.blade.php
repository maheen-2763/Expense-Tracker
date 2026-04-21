@extends('layouts.app')

@section('title', 'Edit Expense')

@section('content')

<div class="flex items-center justify-center min-h-[80vh]">

    <!-- Card -->
    <div class="w-full max-w-lg bg-white shadow-md rounded-2xl p-6 md:p-8">

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            Edit Expense
        </h2>

        <!-- Form -->
        <form method="POST" action="{{ route('expenses.update', $expense->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Title
                </label>
                <input 
                    type="text" 
                    name="title"
                    value="{{ old('title', $expense->title) }}"
                    placeholder="Enter expense title"
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none
                        @error('title') border-red-500 @enderror"
                >

                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Amount
                </label>
                <input 
                    type="number" 
                    name="amount"
                    value="{{ old('amount', $expense->amount) }}"
                    placeholder="Enter amount"
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none
                        @error('amount') border-red-500 @enderror">

                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Type
                </label>
                <select 
                    name="type"
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none
                        @error('type') border-red-500 @enderror"
                >
                    <option value="">Select type</option>
                    <option value="income" {{ old('type', $expense->type) == 'income' ? 'selected' : '' }}>Income</option>
                    <option value="expense" {{ old('type', $expense->type) == 'expense' ? 'selected' : '' }}>Expense</option>
                </select>

                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Date
                </label>
                <input 
                type="date" 
                name="date"
                value="{{ old('date', $expense->date?->format('Y-m-d') ?? '') }}"
                class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none
                @error('date') border-red-500 @enderror"
/>

                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-2">
                <button 
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2.5 rounded-xl font-medium hover:bg-blue-600 transition"
                >
                    Update Expense
                </button>
            </div>

        </form>

    </div>
</div>

@endsection