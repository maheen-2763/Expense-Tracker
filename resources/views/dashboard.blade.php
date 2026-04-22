@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    @if(session('welcome'))
    <div 
        class="md:col-span-3 bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 transition-opacity duration-500"
        id="welcome-alert"
    >
        {{ session('welcome') }}
    </div>
@endif

    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Income</p>
        <h2 class="text-3xl font-semibold text-green-600 mt-2">
            ₹ {{ number_format($income) }}
        </h2>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Expenses</p>
        <h2 class="text-3xl font-semibold text-red-500 mt-2">
            ₹ {{ number_format($expense) }}
        </h2>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Balance</p>
        <h2 class="text-3xl font-semibold text-blue-600 mt-2">
            ₹ {{ number_format($balance) }}
        </h2>
    </div>

</div>

<!-- Main Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Chart -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Monthly Expenses</h3>
            <span class="text-sm text-gray-400">This year</span>
        </div>

        <canvas id="expenseChart" class="mt-4"></canvas>
    </div>

    <!-- Insights + Recent -->
    <div class="flex flex-col gap-6">

        <!-- Total Transactions -->
       <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition">
    <p class="text-sm text-gray-500">Total Transactions</p>
    <h2 class="text-xl font-semibold text-gray-800 mt-2">
        {{ $recent->count() }}
    </h2>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Recent Transactions
            </h3>

            <ul class="divide-y">

                @forelse($recent as $item)
                    <li class="flex justify-between items-center py-3 hover:bg-gray-50 px-2 rounded transition">

                        <div>
                            <p class="text-sm font-medium text-gray-800">
                                {{ $item->title }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                            </p>
                        </div>

                        <span class="text-sm font-semibold 
                            {{ $item->type == 'income' ? 'text-green-600' : 'text-red-500' }}">
                            ₹ {{ number_format($item->amount) }}
                        </span>

                    </li>
                @empty
                    <li class="text-center text-gray-400 py-4">
                        No transactions yet
                    </li>
                @endforelse

            </ul>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('expenseChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($monthly->toArray())) !!},
            datasets: [{
                label: 'Expenses',
                data: {!! json_encode(array_values($monthly->toArray())) !!},
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    grid: {
                        color: '#f1f5f9'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush