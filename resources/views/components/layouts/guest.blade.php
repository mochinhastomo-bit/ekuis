<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mochin-Kuis' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex">
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 relative overflow-hidden items-center justify-center">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="400" cy="400" r="300" stroke="white" stroke-width="1"/>
                <circle cx="400" cy="400" r="200" stroke="white" stroke-width="1"/>
                <circle cx="400" cy="400" r="100" stroke="white" stroke-width="1"/>
                <line x1="100" y1="400" x2="700" y2="400" stroke="white" stroke-width="0.5"/>
                <line x1="400" y1="100" x2="400" y2="700" stroke="white" stroke-width="0.5"/>
                <rect x="150" y="150" width="500" height="500" stroke="white" stroke-width="0.5" rx="8"/>
                <rect x="250" y="250" width="300" height="300" stroke="white" stroke-width="0.5" rx="8"/>
            </svg>
        </div>

        <div class="relative z-10 text-center px-12">
            <div class="mb-8">
                <svg class="w-28 h-28 mx-auto text-white/90" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M60 15L10 40L60 65L110 40L60 15Z" fill="currentColor" opacity="0.9"/>
                    <path d="M25 48V78C25 78 42 95 60 95C78 95 95 78 95 78V48" stroke="currentColor" stroke-width="3" fill="none"/>
                    <line x1="110" y1="40" x2="110" y2="85" stroke="currentColor" stroke-width="3"/>
                    <circle cx="110" cy="88" r="3" fill="currentColor"/>
                    <path d="M45 55V72C45 72 52 80 60 80C68 80 75 72 75 72V55" stroke="currentColor" stroke-width="2" stroke-dasharray="4 3" opacity="0.5"/>
                </svg>
            </div>

            <h1 class="text-4xl font-bold text-white mb-3">Mochin-Kuis</h1>
            <p class="text-blue-200 text-lg mb-8">Media Ujian Online Perkuliahan</p>

            <div class="space-y-4 text-left max-w-xs mx-auto">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">Timer per Soal</p>
                        <p class="text-blue-300 text-xs">Batas waktu untuk setiap pertanyaan</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">Koreksi Otomatis</p>
                        <p class="text-blue-300 text-xs">Hasil dan nilai langsung tersedia</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">Soal Acak</p>
                        <p class="text-blue-300 text-xs">Urutan soal berbeda tiap mahasiswa</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-6 left-0 right-0 text-center">
            <p class="text-blue-400 text-xs">&copy; {{ date('Y') }} Mochin-Kuis &mdash; Sistem Kuis Akademik</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-12">
        <div class="w-full max-w-md">
            <div class="text-center mb-5 lg:hidden">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-900 rounded-xl mb-2">
                    <svg class="w-8 h-8 text-white" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M60 15L10 40L60 65L110 40L60 15Z" fill="currentColor"/>
                        <path d="M25 48V78C25 78 42 95 60 95C78 95 95 78 95 78V48" stroke="currentColor" stroke-width="5" fill="none"/>
                        <line x1="110" y1="40" x2="110" y2="85" stroke="currentColor" stroke-width="5"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Mochin-Kuis</h1>
                <p class="text-gray-500 text-xs">Media Ujian Online Perkuliahan</p>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>
</html>
