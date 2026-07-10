<x-layouts.app title="Edit Kuis - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-2 mb-4 sm:mb-6">
            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Edit Kuis</h1>
        </div>

        <form method="POST" action="{{ route('quizzes.update', $quiz) }}" class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 space-y-4 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">Judul Kuis</label>
                <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" required
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                @error('title')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">{{ old('description', $quiz->description) }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $quiz->is_active) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-900 focus:ring-blue-800">
                <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan kuis (mahasiswa bisa mengakses)</label>
            </div>

            <div class="flex gap-2 sm:gap-3 pt-2">
                <button type="submit" class="bg-blue-900 text-white px-5 sm:px-6 py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('quizzes.show', $quiz) }}" class="px-5 sm:px-6 py-2.5 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition text-sm">
                    Batal
                </a>
            </div>
        </form>

        <form method="POST" action="{{ route('quizzes.destroy', $quiz) }}" class="mt-6"
            onsubmit="return confirm('Yakin ingin menghapus kuis ini? Semua soal dan data peserta akan ikut terhapus.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium cursor-pointer flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Kuis
            </button>
        </form>
    </div>
</x-layouts.app>
