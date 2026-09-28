<x-layouts.app title="Dashboard Dosen - Mochin-Kuis">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-900" viewBox="0 0 120 120" fill="none">
                <path d="M60 15L10 40L60 65L110 40L60 15Z" fill="currentColor"/>
                <path d="M25 48V78C25 78 42 95 60 95C78 95 95 78 95 78V48" stroke="currentColor" stroke-width="5" fill="none"/>
            </svg>
            <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Kuis Saya</h1>
        </div>
        <a href="{{ route('quizzes.create') }}"
            class="bg-blue-900 text-white px-3 sm:px-5 py-2 sm:py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer flex items-center gap-1.5 text-xs sm:text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Kuis
        </a>
    </div>

    @if($quizzes->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-200 p-8 sm:p-12 text-center shadow-sm">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-gray-500 font-medium">Belum ada kuis</p>
            <p class="text-gray-400 text-sm mt-1">Mulai buat kuis pertama Anda!</p>
        </div>
    @else
        <div class="grid gap-3 sm:gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($quizzes as $quiz)
                <a href="{{ route('quizzes.show', $quiz) }}"
                    class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-5 hover:shadow-md hover:border-blue-200 transition group block">
                    <div class="flex items-start justify-between mb-2 sm:mb-3">
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-900 transition text-sm sm:text-base leading-tight flex-1 mr-3">{{ $quiz->title }}</h3>
                        <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-medium {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ Str::limit($quiz->description, 80) }}</p>
                    @if($quiz->periode || $quiz->prodi || $quiz->matakuliah)
                    <div class="flex flex-wrap gap-1.5 mb-3">
                        @if($quiz->periode)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-indigo-50 text-indigo-700 text-[10px] sm:text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $quiz->periode->nama }}
                        </span>
                        @endif
                        @if($quiz->prodi)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] sm:text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            {{ $quiz->prodi->nama }}
                        </span>
                        @endif
                        @if($quiz->matakuliah)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-amber-50 text-amber-700 text-[10px] sm:text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            {{ $quiz->matakuliah->nama }}
                        </span>
                        @endif
                    </div>
                    @endif
                    <div class="flex items-center gap-3 sm:gap-4 text-xs sm:text-sm text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $quiz->questions_count }} soal
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $quiz->attempts_count }} peserta
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-mono bg-blue-50 text-blue-900 px-2.5 py-1 rounded-lg text-xs font-bold tracking-wider">{{ $quiz->code }}</span>
                        <span class="text-xs text-blue-900 font-semibold group-hover:translate-x-0.5 transition-transform flex items-center gap-1">
                            Detail
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-layouts.app>
