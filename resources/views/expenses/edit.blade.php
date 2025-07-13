<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Pengeluaran</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}" required class="w-full border rounded px-3 py-2">

            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nominal</label>
                <input type="number" name="amount" value="{{ old('amount', $expense->amount) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $expense->description) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
