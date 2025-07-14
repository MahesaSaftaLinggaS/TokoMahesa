<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">💸 Tambah Pengeluaran</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-6 mt-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('expenses.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">📅 Tanggal Pengeluaran</label>
                <input type="date" id="date" name="date"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">💰 Nominal</label>
                <input type="number" id="amount" name="amount" placeholder="Misal: 50000"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">📝 Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Penjelasan atau catatan tambahan..."></textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 shadow-sm">
                    ✅ Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>