@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-4 md:px-8 py-6">

    <!-- Welcome Alert -->
    @if(session('welcome'))
        <div id="welcome-alert"
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 shadow-sm transition-opacity duration-500">
            {{ session('welcome') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-sm text-gray-500">Total Income</p>
            <h2 class="text-2xl font-semibold text-green-600 mt-2 tracking-tight">
                ₹ {{ number_format($income, 2) }}
            </h2>
        </div>

        <div class="bg-white/80 backdrop-blur border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-sm text-gray-500">Total Expenses</p>
            <h2 class="text-2xl font-semibold text-red-500 mt-2 tracking-tight">
                ₹ {{ number_format($expense, 2) }}
            </h2>
        </div>

        <div class="bg-white/80 backdrop-blur border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-sm text-gray-500">Balance</p>
            <h2 class="text-2xl font-semibold mt-2 tracking-tight
                {{ $balance >= 0 ? 'text-green-600' : 'text-red-500' }}">
                ₹ {{ number_format($balance, 2) }}
            </h2>
        </div>

    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Chart Card -->
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 tracking-tight">
                        Monthly Breakdown
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">Overview of this year</p>
                </div>
            </div>

            <canvas id="expenseChart"></canvas>
        </div>

        <!-- Right Panel -->
        <div class="flex flex-col gap-6">

            <!-- Transactions Count -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <p class="text-sm text-gray-500">Total Transactions</p>
                <h2 class="text-2xl font-semibold text-gray-800 mt-2 tracking-tight">
                    {{ $totalTransactions }}
                </h2>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 tracking-tight">
                        Recent Transactions
                    </h3>

                    <a href="{{ route('expenses.index') }}"
                       class="text-sm text-blue-600 hover:text-blue-700 transition">
                        View all →
                    </a>
                </div>

                <ul class="divide-y">

                    @forelse($recent as $item)
                        <li class="flex justify-between items-center py-3 px-2 rounded-lg hover:bg-gray-50 transition">

                            <div>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $item->title }}
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $item->date->format('d M Y') }}
                                </p>
                            </div>

                            <span class="text-sm font-semibold
                                {{ $item->type == 'income' ? 'text-green-600' : 'text-red-500' }}">
                                ₹ {{ number_format($item->amount, 2) }}
                            </span>

                        </li>
                    @empty
                        <li class="text-center text-gray-400 py-6 text-sm">
                            No transactions yet
                        </li>
                    @endforelse

                </ul>

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

