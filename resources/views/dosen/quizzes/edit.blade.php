<x-layouts.app title="Edit Kuis - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Kuis</h1>

        <form method="POST" action="{{ route('quizzes.update', $quiz) }}" class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kuis</label>
                <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="3">{{ old('description', $quiz->description) }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $quiz->is_active) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan kuis (mahasiswa bisa mengakses)</label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('quizzes.show', $quiz) }}" class="px-6 py-2 rounded-lg font-medium text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>

        <form method="POST" action="{{ route('quizzes.destroy', $quiz) }}" class="mt-6"
            onsubmit="return confirm('Yakin ingin menghapus kuis ini? Semua soal dan data peserta akan ikut terhapus.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                Hapus Kuis
            </button>
        </form>
    </div>
</x-layouts.app>
