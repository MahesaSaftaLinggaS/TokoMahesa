<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">✏️ Edit Pengeluaran</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-6 mt-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('expenses.update', $expense->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">📅 Tanggal</label>
                <input type="date" id="date" name="date"
                    value="{{ old('date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500">
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">💰 Nominal</label>
                <input type="number" id="amount" name="amount"
                    value="{{ old('amount', $expense->amount) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500"
                    placeholder="Misal: 100000">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">📝 Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500"
                    placeholder="Misalnya: Pembelian alat kebersihan">{{ old('description', $expense->description) }}</textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm">
                    ✅ Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>