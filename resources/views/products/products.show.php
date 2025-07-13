<form method="POST" action="{{ route('orders.store') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="number" name="quantity" min="1" max="{{ $product->stock }}" required class="border px-2 py-1 rounded">
    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Pesan</button>
</form>
