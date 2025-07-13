<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Produk</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Link Gambar</label>
                <input type="url" name="image_url" value="{{ old('image_url', $product->image_url) }}" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Produk</button>
        </form>
    </div>
</x-app-layout>
