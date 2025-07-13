<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah Produk</h2>
    </x-slot>

    <div class="py-4">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" class="w-full border rounded" required>
            </div>
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="description" class="w-full border rounded"></textarea>
            </div>
            <div class="mb-4">
                <label>Harga</label>
                <input type="number" name="price" class="w-full border rounded" required>
            </div>
            <div class="mb-4">
                <label>Stok</label>
                <input type="number" name="stock" class="w-full border rounded" required>
            </div>
            <div class="mb-4">
                <label>URL Gambar (sementara)</label>
                <input type="text" name="image_url" class="w-full border rounded">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
