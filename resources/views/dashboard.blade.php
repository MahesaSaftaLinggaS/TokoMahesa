<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard</h2>
    </x-slot>

    <div class="py-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Total Produk -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-lg">Total Produk</h3>
            <p class="text-2xl font-bold mt-2">{{ $productCount }}</p>
            <a href="{{ route('products.index') }}" class="text-blue-500 text-sm mt-2 inline-block">Lihat Produk</a>
        </div>

        <!-- Total Pengeluaran Bulan Ini -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-lg">Pengeluaran Bulan Ini</h3>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($monthlyExpense) }}</p>
            <a href="{{ route('expenses.index') }}" class="text-blue-500 text-sm mt-2 inline-block">Lihat Pengeluaran</a>
        </div>
    </div>

    <!-- Statistik Tambahan -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-lg">Produk Stok Terbanyak</h3>
            @if($mostStockProduct)
                <p class="mt-2">{{ $mostStockProduct->name }} ({{ $mostStockProduct->stock }} pcs)</p>
            @else
                <p class="mt-2 text-gray-500">-</p>
            @endif
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-lg">Pengeluaran Tertinggi</h3>
            @if($highestExpense)
                <p class="mt-2">Rp {{ number_format($highestExpense->amount) }} ({{ $highestExpense->description }})</p>
            @else
                <p class="mt-2 text-gray-500">-</p>
            @endif
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-lg">Produk Hampir Habis</h3>
            @forelse ($lowStockProducts as $product)
                <p class="mt-1">{{ $product->name }} - {{ $product->stock }} pcs</p>
            @empty
                <p class="mt-2 text-gray-500">Semua stok aman</p>
            @endforelse
        </div>
    </div>

    <!-- Pengeluaran Terbaru -->
    <div class="mt-8 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-2">Pengeluaran Terbaru</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b font-semibold">
                    <th class="py-2 text-left">Tanggal</th>
                    <th class="py-2 text-left">Nominal</th>
                    <th class="py-2 text-left">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentExpenses as $expense)
                    <tr class="border-b">
                        <td class="py-2">{{ $expense->date }}</td>
                        <td class="py-2">Rp {{ number_format($expense->amount) }}</td>
                        <td class="py-2">{{ $expense->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-2 text-center text-gray-500">Belum ada pengeluaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Grafik Pengeluaran -->
    <div class="mt-10 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Grafik Pengeluaran per Bulan</h3>
        <canvas id="expenseChart" height="100"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        const expenseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($expenseLabels),
                datasets: [{
                    label: 'Total Pengeluaran',
                    data: @json($expenseData),
                    backgroundColor: '#3B82F6'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
