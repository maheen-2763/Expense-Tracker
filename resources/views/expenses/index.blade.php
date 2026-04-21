@extends('layouts.app')

@section('title', 'Expenses')

@section('content')

<div class="p-4 md:p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Expenses</h1>

        <div class="flex gap-3 w-full md:w-auto">

            <!-- Search -->
            <input 
                type="text" 
                placeholder="Search..." 
                class="w-full md:w-64 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >

            <!-- Add Button -->
            <a href="{{ route('expenses.create') }}"
               class="bg-blue-500 text-white px-5 py-2 rounded-xl hover:bg-blue-600 transition whitespace-nowrap">
                + Add Expense
            </a>
        </div>
    </div>
      


    <!-- Card -->
    <div class="bg-white shadow-md rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-left">

                <!-- Table Head -->
                <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="p-4">Title</th>
                        <th class="p-4">Amount</th>
                        <th class="p-4">Type</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="text-gray-700">

                    @forelse($expenses as $expense)
                        <tr class="border-t even:bg-gray-50 hover:bg-blue-50 transition">

                            <!-- Title -->
                            <td class="p-4 font-medium">
                                {{ $expense->title }}
                            </td>

                            <!-- Amount -->
                            <td class="p-4 font-semibold 
                                {{ $expense->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                ₹ {{ number_format($expense->amount) }}
                            </td>

                            <!-- Type Badge -->
                            <td class="p-4">
                                <span class="px-3 py-1 text-sm rounded-full
                                    {{ $expense->type == 'income' 
                                        ? 'bg-green-100 text-green-600' 
                                        : 'bg-red-100 text-red-600' }}">
                                    {{ ucfirst($expense->type) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="p-4 flex justify-center gap-2 flex-wrap">

                                <a href="{{ route('expenses.show', $expense->id) }}"
                                   class="px-3 py-1.5 text-sm bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                    View
                                </a>

                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                   class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                    Edit
                                </a>

                                <form method="POST" 
                                      action="{{ route('expenses.destroy', $expense->id) }}"
                                      onsubmit="return confirm('Delete this expense?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1.5 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <!-- Empty State -->
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <p class="text-lg">No expenses found</p>
                                    <a href="{{ route('expenses.create') }}"
                                       class="text-blue-500 hover:underline">
                                        + Add your first expense
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t">
            {{ $expenses->links() }}
        </div>

    </div>
</div>

@endsection