@extends('layouts.app')

@section('title', 'Expenses')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-8 py-10 space-y-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900 tracking-tight">
                    Expenses
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Manage and track your transactions
                </p>
            </div>

            <a href="{{ route('expenses.create') }}"
               class="inline-flex items-center gap-2 bg-gray-900 text-white px-5 py-2.5
                      rounded-xl hover:bg-gray-800 active:scale-[0.98] transition text-sm font-medium shadow-sm">
                + Add Expense
            </a>

        </div>

        <!-- Table Card -->
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <!-- Head -->
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-4 text-left">Title</th>
                            <th class="p-4 text-left">Amount</th>
                            <th class="p-4 text-left">Type</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y divide-gray-100">

                        @forelse($expenses as $expense)
                            <tr class="hover:bg-gray-50 transition group">

                                <!-- Title -->
                                <td class="p-4">
                                    <div class="font-medium text-gray-900 group-hover:text-black">
                                        {{ $expense->title }}
                                    </div>
                                </td>

                                <!-- Amount -->
                                <td class="p-4 font-semibold
                                    {{ $expense->type == 'income' ? 'text-emerald-600' : 'text-red-500' }}">
                                    ₹ {{ number_format($expense->amount, 2) }}
                                </td>

                                <!-- Type -->
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                        {{ $expense->type == 'income'
                                            ? 'bg-emerald-50 text-emerald-600'
                                            : 'bg-red-50 text-red-500' }}">
                                        {{ ucfirst($expense->type) }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="p-4">
                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('expenses.show', $expense->id) }}"
                                           class="px-3 py-1.5 text-xs rounded-lg bg-gray-100 hover:bg-gray-200 transition">
                                            View
                                        </a>

                                        <a href="{{ route('expenses.edit', $expense->id) }}"
                                           class="px-3 py-1.5 text-xs rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('expenses.destroy', $expense->id) }}"
                                              onsubmit="return confirm('Delete this expense?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="px-3 py-1.5 text-xs rounded-lg bg-red-500 text-white
                                                           hover:bg-red-600 transition">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <!-- Empty State -->
                            <tr>
                                <td colspan="4" class="py-20 text-center">

                                    <div class="flex flex-col items-center justify-center space-y-3">

                                        <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-400 text-lg">—</span>
                                        </div>

                                        <p class="text-base font-medium text-gray-900">
                                            No expenses yet
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            Start by adding your first transaction
                                        </p>

                                        <a href="{{ route('expenses.create') }}"
                                           class="mt-2 inline-flex items-center px-4 py-2 bg-gray-900 text-white
                                                  rounded-xl hover:bg-gray-800 transition text-sm">
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
            <div class="border-t border-gray-100 bg-gray-50 px-4 py-3">
                <div class="text-sm text-gray-500">
                    {{ $expenses->appends(request()->all())->links() }}
                </div>
            </div>

        </div>

    </div>

</div>

@endsection