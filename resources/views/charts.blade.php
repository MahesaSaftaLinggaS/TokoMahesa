<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📊 Statistik Visual</h2>
    </x-slot>

    <div class="py-8 px-4 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Grafik Pengeluaran -->
        <div class="bg-white rounded-2xl p-6 shadow">
            <h3 class="text-lg font-bold mb-4 text-gray-700">📉 Pengeluaran per Bulan</h3>
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
                            callback: value => 'Rp ' + value.toLocaleString()
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
