<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard</h2>
    </x-slot>

    <!-- Statistik Ringkas -->
    <div class="py-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-dashboard.card title="Total Produk" link="{{ route('products.index') }}" linkText="Lihat Produk">
            <p class="text-2xl font-bold mt-2">{{ $productCount }}</p>
        </x-dashboard.card>

        <x-dashboard.card title="Pengeluaran Bulan Ini" link="{{ route('expenses.index') }}" linkText="Lihat Pengeluaran">
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($monthlyExpense) }}</p>
        </x-dashboard.card>
    </div>

    <!-- Statistik Tambahan -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- Produk Stok Terbanyak --}}
        @if($mostStockProduct)
            <x-dashboard.card
                title="Produk Stok Terbanyak"
                image="{{ $mostStockProduct->image_url }}"
                description="{{ $mostStockProduct->description }}"
                link="{{ route('products.show', $mostStockProduct->id) }}"
                linkText="Lihat Detail Produk">
                <p class="text-lg font-bold">
                    {{ $mostStockProduct->name }} ({{ $mostStockProduct->stock }} pcs)
                </p>
            </x-dashboard.card>
        @else
            <x-dashboard.card title="Produk Stok Terbanyak">
                <p class="mt-2 text-gray-500">Tidak ada data produk</p>
            </x-dashboard.card>
        @endif

        {{-- Pengeluaran Tertinggi --}}
        <x-dashboard.card title="Pengeluaran Tertinggi">
            @if($highestExpense)
                <p class="mt-2">Rp {{ number_format($highestExpense->amount) }} ({{ $highestExpense->description }})</p>
            @else
                <p class="mt-2 text-gray-500">-</p>
            @endif
        </x-dashboard.card>

        {{-- Produk Hampir Habis --}}
        <x-dashboard.card title="Produk Hampir Habis">
            @forelse ($lowStockProducts as $product)
                <p class="mt-1">{{ $product->name }} - {{ $product->stock }} pcs</p>
            @empty
                <p class="mt-2 text-gray-500">Semua stok aman</p>
            @endforelse
        </x-dashboard.card>
    </div>

    <!-- Pengeluaran Terbaru -->
    <div class="mt-8 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Pengeluaran Terbaru</h3>
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

    <!-- Grafik Stok Produk -->
    <div class="mt-10 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Grafik Stok Produk</h3>
        <canvas id="stockChart" height="100"></canvas>
    </div>

    <!-- Form Pemesanan Per Produk -->
    <div class="mt-10">
        <h3 class="text-lg font-bold mb-4">Form Pemesanan Produk</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
                <x-dashboard.card
                    title="{{ $product->name }}"
                    image="{{ $product->image_url }}"
                    description="Stok: {{ $product->stock }}"
                >
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" min="1" max="{{ $product->stock }}"
                               class="border px-2 py-1 w-full rounded mb-2" required>
                        <button type="submit" class="bg-green-500 text-white w-full py-1 rounded">Pesan</button>
                    </form>
                </x-dashboard.card>
            @endforeach
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        new Chart(ctx, {
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
                            callback: value => 'Rp ' + value.toLocaleString()
                        }
                    }
                }
            }
        });

        const ctx2 = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($products->pluck('name')),
                datasets: [{
                    label: 'Stok Produk',
                    data: @json($products->pluck('stock')),
                    backgroundColor: '#10B981'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
