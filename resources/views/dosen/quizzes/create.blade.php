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

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="periode_id" class="block text-sm font-medium text-gray-700 mb-1.5">Periode Akademik</label>
                    <select name="periode_id" id="periode_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodes as $p)
                            <option value="{{ $p->id }}" {{ old('periode_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-1.5">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                        <option value="">-- Pilih Prodi --</option>
                        @foreach($prodis as $p)
                            <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="matakuliah_id" class="block text-sm font-medium text-gray-700 mb-1.5">Mata Kuliah</label>
                    <select name="matakuliah_id" id="matakuliah_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                        <option value="">-- Pilih Matakuliah --</option>
                        @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->id }}" {{ old('matakuliah_id') == $mk->id ? 'selected' : '' }}>{{ $mk->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1.5">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

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
