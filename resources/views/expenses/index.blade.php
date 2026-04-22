@extends('layouts.app')

@section('title', 'Expenses')

@section('content')

<div class="p-4 md:p-8 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
        
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
            Expenses
        </h1>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <!-- Add Button -->
            <a href="{{ route('expenses.create') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 active:scale-95 transition font-medium shadow-sm text-center">
                + Add Expense
            </a>

        </div>
    </div>


    <!-- Card -->
    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- Table Head -->
                <thead class="bg-gray-50 text-gray-500 uppercase tracking-wide text-xs">
                    <tr>
                        <th class="p-4 text-left">Title</th>
                        <th class="p-4 text-left">Amount</th>
                        <th class="p-4 text-left">Type</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y">

                    @forelse($expenses as $expense)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- Title -->
                            <td class="p-4 font-medium text-gray-800">
                                {{ $expense->title }}
                            </td>

                            <!-- Amount -->
                            <td class="p-4 font-semibold
                                {{ $expense->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                ₹ {{ number_format($expense->amount, 2) }}
                            </td>

                            <!-- Type -->
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $expense->type == 'income'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($expense->type) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="p-4 flex justify-center gap-2 flex-wrap">

                                <a href="{{ route('expenses.show', $expense->id) }}"
                                   class="px-3 py-1.5 text-xs bg-gray-100 hover:bg-gray-200 rounded-md transition">
                                    View
                                </a>

                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                   class="px-3 py-1.5 text-xs bg-blue-600 text-white hover:bg-blue-700 rounded-md transition">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('expenses.destroy', $expense->id) }}"
                                      onsubmit="return confirm('Delete this expense?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1.5 text-xs bg-red-600 text-white hover:bg-red-700 rounded-md transition">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <!-- Empty State -->
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-500">
                                    <p class="text-lg font-medium">No expenses found</p>
                                    <p class="text-sm">Start by adding your first transaction</p>
                                    <a href="{{ route('expenses.create') }}"
                                       class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        + Add Expense
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t bg-gray-50">
            {{ $expenses->appends(request()->all())->links() }}
        </div>

    </div>
</div>

@endsection