<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Produk</h2>
    </x-slot>

    <div class="py-4">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded" required>
            </div>
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="description" class="w-full border rounded">{{ $product->description }}</textarea>
            </div>
            <div class="mb-4">
                <label>Harga</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded" required>
            </div>
            <div class="mb-4">
                <label>Stok</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded" required>
            </div>
            <div class="mb-4">
                <label>URL Gambar</label>
                <input type="text" name="image_url" value="{{ $product->image_url }}" class="w-full border rounded">
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
