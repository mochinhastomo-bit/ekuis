<x-layouts.guest title="Daftar - Mochin-Kuis">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Buat Akun</h2>
            <p class="text-gray-500 text-sm mt-1">Daftar untuk mulai menggunakan Mochin-Kuis</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ role: '{{ old('role', 'mahasiswa') }}' }">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        placeholder="Nama lengkap Anda"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
                @error('name')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Peran</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="role" value="mahasiswa" x-model="role" class="peer sr-only">
                        <div class="flex items-center gap-2 px-4 py-3 rounded-xl border-2 border-gray-200 peer-checked:border-blue-800 peer-checked:bg-blue-50 transition">
                            <svg class="w-5 h-5 text-gray-500 peer-checked:text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Mahasiswa</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="role" value="dosen" x-model="role" class="peer sr-only">
                        <div class="flex items-center gap-2 px-4 py-3 rounded-xl border-2 border-gray-200 peer-checked:border-blue-800 peer-checked:bg-blue-50 transition">
                            <svg class="w-5 h-5 text-gray-500 peer-checked:text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Dosen</span>
                        </div>
                    </label>
                </div>
            </div>

            <div x-show="role === 'mahasiswa'" x-cloak>
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-1.5">NIM</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                    </span>
                    <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                        placeholder="Nomor Induk Mahasiswa"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
                @error('nim')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        placeholder="nama@universitas.ac.id"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required
                        placeholder="Minimal 8 karakter"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        placeholder="Ulangi password"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-900 text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer">
                Daftar
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-800 hover:text-blue-900 font-semibold ml-1">Masuk</a>
            </p>
        </div>
    </div>
</x-layouts.guest>
