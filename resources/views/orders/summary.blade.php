<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ringkasan Pesanan') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Daftar Produk
                </a>
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Tambah Produk
                </a>
                <a href="{{ route('expenses.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Daftar Pengeluaran
                </a>
                <a href="{{ route('expenses.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Tambah Pengeluaran
                </a>
                <a href="{{ route('orders.summary') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Ringkasan Pesanan
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($orders->isEmpty())
                        <p>Tidak ada pesanan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">ID Pesanan</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Nama Produk</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Jumlah</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Total Harga</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Tanggal Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="hover:bg-gray-100">
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $order->id }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $order->product->name ?? 'Produk tidak ditemukan' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $order->quantity }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
