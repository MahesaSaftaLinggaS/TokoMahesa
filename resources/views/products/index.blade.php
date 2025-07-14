<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">📦 Daftar Produk</h2>
    </x-slot>

    <!-- Search Form -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="🔍 Cari nama produk..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Cari</button>
        </div>
    </form>

    <!-- Add Button -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('products.create') }}"
           class="inline-block bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition duration-200">
            + Tambah Produk
        </a>
    </div>

    <!-- Product Cards for Mobile & Grid for Desktop -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($products as $product)
        <div class="bg-white border rounded-lg shadow hover:shadow-md transition p-4 flex flex-col justify-between">
            <div class="mb-4">
                <img src="{{ $product->image_url }}" alt="gambar"
                    class="w-full h-40 object-cover rounded-md mb-2">
                <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600">💰 Rp {{ number_format($product->price) }}</p>
                <p class="text-gray-600">📦 Stok: {{ $product->stock }}</p>
            </div>
            <div class="flex gap-3 mt-auto">
                <a href="{{ route('products.edit', $product) }}"
                   class="text-sm bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-sm bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500">Belum ada produk yang tersedia.</p>
        @endforelse
    </div>
</x-app-layout>