<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📊 Statistik Visual</h2>
    </x-slot>

    <div class="py-8 px-4 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Filter Tahun -->
        <div class="bg-white rounded-2xl p-6 shadow mb-6 col-span-full">
            <form method="GET" action="{{ route('charts') }}" class="flex items-center space-x-4">
                <label for="year" class="font-semibold text-gray-700">Filter Tahun:</label>
                <select name="year" id="year" class="border border-gray-300 rounded px-3 py-1" onchange="this.form.submit()">
                    @php
                        $currentYear = now()->year;
                        $startYear = $currentYear - 5; // show last 5 years
                    @endphp
                    @for ($y = $startYear; $y <= $currentYear; $y++)
                        <option value="{{ $y }}" @if(isset($selectedYear) && $selectedYear == $y) selected @endif>{{ $y }}</option>
                    @endfor
                </select>
                <noscript><button type="submit" class="ml-2 px-4 py-1 bg-blue-600 text-white rounded">Apply</button></noscript>
            </form>
        </div>

        <!-- Grafik Pengeluaran -->
        <div class="bg-white rounded-2xl p-6 shadow">
            <h3 class="text-lg font-bold mb-4 text-gray-700">📉 Pengeluaran per Bulan - Tahun {{ $selectedYear ?? now()->year }}</h3>
            <canvas id="expenseChart" height="200"></canvas>
        </div>

        <!-- Grafik Stok Produk -->
        <div class="bg-white rounded-2xl p-6 shadow">
            <h3 class="text-lg font-bold mb-4 text-gray-700">📦 Stok Produk Saat Ini</h3>
            <canvas id="stockChart" height="200"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
        new Chart(expenseCtx, {
            type: 'line',
            data: {
                labels: @json($expenseLabels),
                datasets: [{
                    label: 'Total Pengeluaran',
                    data: @json($expenseData),
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: '#3B82F6',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
ticks: {
    callback: function(value) { return 'Rp ' + value.toLocaleString(); }
}
                    }
                }
            }
        });

        const stockCtx = document.getElementById('stockChart').getContext('2d');
        new Chart(stockCtx, {
            type: 'bar',
            data: {
                labels: @json($products->pluck('name')),
                datasets: [{
                    label: 'Jumlah Stok',
                    data: @json($products->pluck('stock')),
                    backgroundColor: '#10B981'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
