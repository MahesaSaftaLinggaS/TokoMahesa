<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Daftar Pengeluaran</h2>
    </x-slot>

    <form method="GET" action="{{ route('expenses.index') }}" class="mb-4 flex gap-2">
    <select name="month" class="border px-2 py-1 rounded">
        <option value="">Bulan</option>
        @for($m = 1; $m <= 12; $m++)
            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
            </option>
        @endfor
    </select>
    <input type="number" name="year" value="{{ request('year') }}" placeholder="Tahun" class="border px-2 py-1 rounded w-24">
    <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">Filter</button>
</form>


    <div class="py-4">
        <a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Pengeluaran</a>

        <p class="mt-4 font-semibold">Total: Rp {{ number_format($total) }}</p>

        <table class="mt-2 w-full text-sm text-left">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
           <tbody>
    @foreach ($expenses as $e)
        <tr class="border-b">
            <td class="py-2">{{ $e->date }}</td>
            <td class="py-2">Rp {{ number_format($e->amount) }}</td>
            <td class="py-2">{{ $e->description }}</td>
            <td class="py-2 space-x-2">
                <a href="{{ route('expenses.edit', $e->id) }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('expenses.destroy', $e->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus pengeluaran ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
    </div>
</x-app-layout>