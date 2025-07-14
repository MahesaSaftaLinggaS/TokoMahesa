<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">📋 Daftar Pengeluaran</h2>
    </x-slot>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('expenses.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-2">
            <select name="month"
                    class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                <option value="">Bulan</option>
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endfor
            </select>

            <input type="number" name="year" value="{{ request('year') }}" placeholder="Tahun"
                   class="px-3 py-2 border border-gray-300 rounded-md shadow-sm w-full sm:w-28 focus:ring focus:ring-blue-200">

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                🔎 Filter
            </button>
        </div>
    </form>

    <!-- Tambah Pengeluaran Button -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('expenses.create') }}"
           class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition duration-200">
            ➕ Tambah Pengeluaran
        </a>
        <p class="text-lg font-semibold text-gray-700">Total: <span class="text-green-700">Rp {{ number_format($total) }}</span></p>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto shadow-sm rounded-lg border">
        <table class="min-w-full text-sm text-left divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-700">Tanggal</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Nominal</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Deskripsi</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($expenses as $e)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-4 py-3">{{ $e->date }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($e->amount) }}</td>
                    <td class="px-4 py-3">{{ $e->description }}</td>
                    <td class="px-4 py-3 space-x-2 flex">
                        <a href="{{ route('expenses.edit', $e->id) }}"
                           class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('expenses.destroy', $e->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin hapus pengeluaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada pengeluaran yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>