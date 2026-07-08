<x-layouts.guest title="Login - Mochin-Kuis">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 sm:p-8">
        <div class="mb-4 sm:mb-6">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Selamat Datang</h2>
            <p class="text-gray-500 text-sm mt-1">Masuk dengan NIM untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-1.5">NIM</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required autofocus
                        placeholder="Masukkan NIM Anda"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
                @error('nim')
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
                        placeholder="Masukkan password"
                        class="!pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-900 text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer">
                Masuk
            </button>
        </form>
    </div>
</x-layouts.guest>
