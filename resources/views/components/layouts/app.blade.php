<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Mochin-Kuis' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen">
    @php
        $mahasiswa = session('mahasiswa_id') ? \App\Models\Mahasiswa::find(session('mahasiswa_id')) : null;
        $isDosen = auth()->check();
    @endphp

    <nav class="bg-blue-900 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-14 sm:h-16">
                <div class="flex items-center gap-3 sm:gap-5">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white/90" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M60 15L10 40L60 65L110 40L60 15Z" fill="currentColor"/>
                            <path d="M25 48V78C25 78 42 95 60 95C78 95 95 78 95 78V48" stroke="currentColor" stroke-width="4" fill="none"/>
                            <line x1="110" y1="40" x2="110" y2="85" stroke="currentColor" stroke-width="4"/>
                        </svg>
                        <a href="{{ $isDosen ? route('dashboard') : ($mahasiswa ? route('mahasiswa.dashboard') : '/') }}" class="text-base sm:text-xl font-bold text-white">Mochin-Kuis</a>
                    </div>
                    @if($isDosen)
                    <nav class="hidden sm:flex items-center gap-1 text-sm">
                        <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg text-blue-200 hover:text-white hover:bg-white/10 transition {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white' : '' }}">Kuis</a>
                        <a href="{{ route('mahasiswa.index') }}" class="px-3 py-1.5 rounded-lg text-blue-200 hover:text-white hover:bg-white/10 transition {{ request()->routeIs('mahasiswa.*') ? 'bg-white/15 text-white' : '' }}">Mahasiswa</a>
                        <a href="{{ route('master-data.index') }}" class="px-3 py-1.5 rounded-lg text-blue-200 hover:text-white hover:bg-white/10 transition {{ request()->routeIs('master-data.*') ? 'bg-white/15 text-white' : '' }}">Master Data</a>
                    </nav>
                    @endif
                </div>
                <div class="flex items-center gap-2 sm:gap-4">
                    @if($isDosen)
                        <span class="text-xs sm:text-sm text-blue-200 hidden sm:inline">
                            {{ auth()->user()->name }}
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-white/15 text-white ml-1">Dosen</span>
                        </span>
                    @elseif($mahasiswa)
                        <span class="text-xs sm:text-sm text-blue-200 hidden sm:inline">
                            {{ $mahasiswa->name }}
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-white/15 text-white ml-1">Mahasiswa</span>
                        </span>
                    @endif
                    @if($isDosen || $mahasiswa)
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs sm:text-sm text-blue-300 hover:text-white transition cursor-pointer flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @if($isDosen)
    <nav class="sm:hidden bg-white border-b border-gray-200 shadow-sm">
        <div class="flex justify-around text-xs font-medium">
            <a href="{{ route('dashboard') }}" class="flex-1 text-center py-2.5 {{ request()->routeIs('dashboard') || request()->routeIs('quizzes.*') ? 'text-blue-900 border-b-2 border-blue-900' : 'text-gray-500' }}">Kuis</a>
            <a href="{{ route('mahasiswa.index') }}" class="flex-1 text-center py-2.5 {{ request()->routeIs('mahasiswa.*') ? 'text-blue-900 border-b-2 border-blue-900' : 'text-gray-500' }}">Mahasiswa</a>
            <a href="{{ route('master-data.index') }}" class="flex-1 text-center py-2.5 {{ request()->routeIs('master-data.*') ? 'text-blue-900 border-b-2 border-blue-900' : 'text-gray-500' }}">Master Data</a>
        </div>
    </nav>
    @endif

    <main class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>
