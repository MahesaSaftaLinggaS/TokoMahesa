<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Daftar Produk</h2>
    </x-slot>

    <div class="py-4">
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Produk</a>

        <table class="mt-4 w-full text-sm text-left">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-b">
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td><img src="{{ $product->image_url }}" alt="gambar" class="w-16"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
    <p> #####<p>
    <p> #####<p>
    <p> #####<p>
    <p> #####<p>
    <p> #####<p>

    <table class="mt-4 w-full text-sm text-left">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr class="border-b">
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price) }}</td>
                <td>{{ $product->stock }}</td>
                <td><img src="{{ $product->image_url }}" alt="gambar" class="w-16"></td>
                <td class="flex gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</x-app-layout>
