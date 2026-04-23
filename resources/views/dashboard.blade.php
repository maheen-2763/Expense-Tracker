
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-8 py-10 space-y-10">

        <!-- Header -->
        <div class="flex items-end justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900 tracking-tight">
                    Dashboard
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Overview of your financial activity
                </p>
            </div>

            <div class="text-xs text-gray-400">
                {{ now()->format('d M Y') }}
            </div>

        </div>
       
        <!-- Welcome Alert -->
       

        <button class="px-4 py-2 bg-black text-white text-sm rounded-md">
            <a href="{{ route('expenses.create') }}">
    + Add Expense
</a>
</button>


        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <!-- Income -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6
                        hover:shadow-md hover:border-gray-200 transition-all duration-300 group">

                <div class="flex items-center justify-between">
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Income
                    </p>
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-3 tracking-tight">
                    ₹ {{ number_format($income, 2) }}
                </h2>

            </div>

            <!-- Expense -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6
                        hover:shadow-md hover:border-gray-200 transition-all duration-300">

                <div class="flex items-center justify-between">
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Expenses
                    </p>
                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-3 tracking-tight">
                    ₹ {{ number_format($expense, 2) }}
                </h2>

            </div>

            <!-- Balance -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6
                        hover:shadow-md hover:border-gray-200 transition-all duration-300">

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Balance
                </p>

                <h2 class="text-2xl font-semibold mt-3 tracking-tight
                    {{ $balance >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                    ₹ {{ number_format($balance, 2) }}
                </h2>

            </div>

        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Chart -->
            <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6
                        hover:shadow-md transition-all duration-300">

                <div class="mb-6">
                    <h3 class="text-base font-semibold text-gray-900">
                        Financial Overview
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">
                        Income vs expenses (yearly)
                    </p>
                </div>

                <canvas id="expenseChart"></canvas>

            </div>

            <!-- Right Panel -->
            <div class="space-y-5">

                <!-- Transactions -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6
                            hover:shadow-md transition-all duration-300">

                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Transactions
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-900 mt-3">
                        {{ $totalTransactions }}
                    </h2>

                </div>

                <!-- Recent -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6
                            hover:shadow-md transition-all duration-300">

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">
                                Recent
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">
                                Latest activity
                            </p>
                        </div>

                        <a href="{{ route('expenses.index') }}"
                           class="text-xs text-gray-500 hover:text-gray-900 transition">
                            View →
                        </a>
                    </div>

                    <ul class="space-y-2">

                        @forelse($recent as $item)
                            <li class="flex justify-between items-center py-2 px-2 rounded-lg
                                       hover:bg-gray-50 transition">

                                <div>
                                    <p class="text-sm text-gray-900 font-medium">
                                        {{ $item->title }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $item->date->format('d M Y') }}
                                    </p>
                                </div>

                                <span class="text-sm font-medium
                                    {{ $item->type == 'income' ? 'text-emerald-600' : 'text-red-500' }}">
                                    ₹ {{ number_format($item->amount, 2) }}
                                </span>

                            </li>
                        @empty
                            <li class="text-sm text-gray-400 text-center py-6">
                                No expenses yet — start by adding your first one ↑

                            </li>
                        @endforelse

                    </ul>

                </div>

            </div>

        </div>

    </div>
</div>


@endsection
@push('scripts')
<script>
    // Auto-hide welcome alert after 3 seconds
    setTimeout(() => {
        const alert = document.getElementById('welcome-alert');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>
@endpush

@push('scripts')
<script>
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');

    const colors = {
        success: 'bg-emerald-50 border-emerald-200 text-emerald-700',
        error: 'bg-red-50 border-red-200 text-red-700',
        info: 'bg-blue-50 border-blue-200 text-blue-700'
    };

    const toast = document.createElement('div');
    toast.className = `
        px-4 py-3 rounded-lg border shadow-sm text-sm
        ${colors[type]}
        opacity-0 translate-y-2 transition-all duration-300
    `;

    toast.innerText = message;

    container.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.classList.remove('opacity-0', 'translate-y-2');
    }, 10);

    // Auto remove
    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>
@endpush



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('expenseChart');
    if (!ctx) return;

    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    const incomeRaw = @json($monthlyIncome);
    const expenseRaw = @json($monthlyExpense);

    const incomeData = Array.from({length: 12}, (_, i) => incomeRaw[i+1] ?? 0);
    const expenseData = Array.from({length: 12}, (_, i) => expenseRaw[i+1] ?? 0);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Income',
                    data: incomeData,
                    backgroundColor: '#22c55e', // green
                    borderRadius: 6
                },
                {
                    label: 'Expense',
                    data: expenseData,
                    backgroundColor: '#ef4444', // red
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

});
</script>
@endpush

