<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Daftar Pengeluaran</h2>
    </x-slot>

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
                        <td>{{ $e->date }}</td>
                        <td>Rp {{ number_format($e->amount) }}</td>
                        <td>{{ $e->description }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('expenses.edit', $e) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('expenses.destroy', $e) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
