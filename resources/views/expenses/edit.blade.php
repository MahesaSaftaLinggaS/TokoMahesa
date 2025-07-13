<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Pengeluaran</h2>
    </x-slot>

    <form method="POST" action="{{ route('expenses.update', $expense) }}" class="py-4">
        @csrf @method('PUT')
        <input type="date" name="date" value="{{ $expense->date }}" class="w-full border rounded mb-2" required>
        <input type="number" name="amount" value="{{ $expense->amount }}" class="w-full border rounded mb-2" required>
        <textarea name="description" class="w-full border rounded mb-2">{{ $expense->description }}</textarea>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</x-app-layout>
