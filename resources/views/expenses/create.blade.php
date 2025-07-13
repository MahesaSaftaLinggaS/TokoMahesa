<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah Pengeluaran</h2>
    </x-slot>

    <form method="POST" action="{{ route('expenses.store') }}" class="py-4">
        @csrf
        <input type="date" name="date" class="w-full border rounded mb-2" required>
        <input type="number" name="amount" placeholder="Nominal" class="w-full border rounded mb-2" required>
        <textarea name="description" placeholder="Deskripsi" class="w-full border rounded mb-2"></textarea>
        <button class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</x-app-layout>
