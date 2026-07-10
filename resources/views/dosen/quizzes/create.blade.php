<x-layouts.app title="Buat Kuis - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-2 mb-4 sm:mb-6">
            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Buat Kuis Baru</h1>
        </div>

        <form method="POST" action="{{ route('quizzes.store') }}" class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 space-y-4 shadow-sm">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">Judul Kuis</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                    placeholder="Masukkan judul kuis"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                @error('title')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    placeholder="Deskripsi singkat tentang kuis ini"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 sm:gap-3 pt-2">
                <button type="submit" class="bg-blue-900 text-white px-5 sm:px-6 py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer text-sm">
                    Simpan
                </button>
                <a href="{{ route('dashboard') }}" class="px-5 sm:px-6 py-2.5 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
