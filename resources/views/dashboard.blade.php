<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">📦 Ringkasan Pesanan</h2>
            <div class="flex flex-wrap gap-2">
                @php
                    $menuItems = [
                        ['label' => '🛒 Daftar Produk', 'route' => 'products.index', 'color' => 'blue'],
                        ['label' => '➕ Tambah Produk', 'route' => 'products.create', 'color' => 'blue'],
                        ['label' => '💸 Daftar Pengeluaran', 'route' => 'expenses.index', 'color' => 'green'],
                        ['label' => '➕ Tambah Pengeluaran', 'route' => 'expenses.create', 'color' => 'green'],
                        ['label' => '📊 Ringkasan Pesanan', 'route' => 'orders.summary', 'color' => 'indigo'],
                    ];
                @endphp

                <a href="{{ route('charts') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-xs rounded font-semibold transition">
    Lihat Grafik
</a>


                @foreach ($menuItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="px-4 py-2 rounded-full text-sm font-semibold text-white bg-{{ $item['color'] }}-600 hover:bg-{{ $item['color'] }}-700 shadow transition">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </x-slot>

    <!-- 📦 Form Pemesanan Produk -->
    <div class="mt-10">
        <h3 class="text-xl font-bold mb-6">🛍️ Pesan Produk</h3>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group relative">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif

                    <div class="p-4">
                        <h4 class="font-semibold text-lg text-gray-800">{{ $product->name }}</h4>
                        <p class="text-sm text-gray-500 mb-2">{{ $product->description }}</p>

                        <div class="flex justify-between items-center text-sm text-gray-600 mb-3">
                            <span>Stok: <strong>{{ $product->stock }}</strong></span>
                            @if($product->stock <= 5)
                                <span class="text-red-500 font-bold">⚠️ Hampir habis</span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   max="{{ $product->stock }}"
                                   class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-300 mb-2"
                                   placeholder="Jumlah" required>

                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-2 rounded-md font-semibold hover:from-green-600 hover:to-green-700 transition">
                                Pesan Sekarang
                            </button>
                        </form>
                    </div>

                    <!-- Badge -->
                    @if($product->stock > 10)
                        <span class="absolute top-2 right-2 bg-yellow-400 text-xs px-2 py-1 rounded-full font-bold text-white shadow">
                            🌟 Terlaris
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
