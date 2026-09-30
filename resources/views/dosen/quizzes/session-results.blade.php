<x-layouts.app title="Hasil {{ $session->name }} - Mochin-Kuis">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 mb-4 sm:mb-6 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-900">{{ $session->name }}</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ $quiz->title }}</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs text-gray-500">
                        @if($quiz->periode)
                            <span>Periode: <strong class="text-gray-700">{{ $quiz->periode->nama }}</strong></span>
                        @endif
                        @if($quiz->prodi)
                            <span>Prodi: <strong class="text-gray-700">{{ $quiz->prodi->nama }}</strong></span>
                        @endif
                        @if($quiz->matakuliah)
                            <span>MK: <strong class="text-gray-700">{{ $quiz->matakuliah->nama }}</strong></span>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs text-gray-500">
                        <span>Mulai: <strong class="text-gray-700">{{ $session->started_at?->format('d M Y H:i') }}</strong></span>
                        @if($session->ended_at)
                            <span>Selesai: <strong class="text-gray-700">{{ $session->ended_at->format('d M Y H:i') }}</strong></span>
                        @endif
                        <span>Peserta: <strong class="text-gray-700">{{ $session->attempts->count() }}</strong></span>
                    </div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-medium {{ $session->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                    {{ $session->is_active ? 'Aktif' : 'Selesai' }}
                </span>
            </div>
        </div>

        {{-- Status Ringkasan (sesi aktif) --}}
        @if($session->is_active && $session->attempts->isNotEmpty())
            @php
                $selesai = $session->attempts->whereNotNull('completed_at')->count();
                $belumSelesai = $session->attempts->whereNull('completed_at')->count();
                $total = $session->attempts->count();
            @endphp
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 sm:p-5 mb-4 sm:mb-6 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="font-bold text-amber-900 text-sm sm:text-base">Status Pengerjaan</h2>
                </div>
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="bg-white rounded-xl p-3 border border-amber-100">
                        <p class="text-2xl font-bold text-gray-900">{{ $total }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Total Peserta</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-green-100">
                        <p class="text-2xl font-bold text-green-600">{{ $selesai }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Selesai</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-red-100">
                        <p class="text-2xl font-bold {{ $belumSelesai > 0 ? 'text-red-600' : 'text-gray-400' }}">{{ $belumSelesai }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Sedang Mengerjakan</p>
                    </div>
                </div>
                @if($belumSelesai > 0)
                    <p class="text-xs text-amber-700 mt-3 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Masih ada {{ $belumSelesai }} mahasiswa yang belum selesai mengerjakan kuis.
                    </p>
                @else
                    <p class="text-xs text-green-700 mt-3 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Semua mahasiswa sudah selesai mengerjakan kuis. Aman untuk mengakhiri sesi.
                    </p>
                @endif
            </div>
        @endif

        {{-- Hasil Peserta --}}
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 mb-3 sm:mb-4">
                <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h2 class="text-base sm:text-lg font-bold text-gray-900">Hasil Peserta ({{ $session->attempts->count() }})</h2>
            </div>

            @if($session->attempts->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-200 p-6 sm:p-8 text-center shadow-sm">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">Belum ada peserta di sesi ini</p>
                </div>
            @else
                {{-- Mobile: Card layout --}}
                <div class="sm:hidden space-y-2">
                    @foreach($session->attempts->sortByDesc('score') as $ri => $attempt)
                        <a href="{{ route('quiz.result', $attempt) }}" class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex items-center justify-between gap-3 block">
                            <div class="flex items-center gap-2 flex-1 min-w-0">
                                <span class="shrink-0 w-6 h-6 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold">{{ $ri + 1 }}</span>
                                <div class="min-w-0">
                                    <p class="font-medium text-gray-900 text-sm truncate">{{ $attempt->mahasiswa->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $attempt->mahasiswa->nim }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                @if($attempt->completed_at)
                                    <span class="text-lg font-bold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : ($attempt->scorePercentage() >= 50 ? 'text-yellow-600' : 'text-red-600') }}">{{ $attempt->scorePercentage() }}%</span>
                                    <p class="text-xs text-gray-400">{{ $attempt->score }}/{{ $attempt->total_questions }}</p>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs text-amber-600 font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Mengerjakan
                                    </span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Desktop: Table layout --}}
                <div class="hidden sm:block bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-center px-3 py-3 font-semibold text-gray-700 w-12">No</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-700">Nama</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-700">NIM</th>
                                <th class="text-center px-4 py-3 font-semibold text-gray-700">Skor</th>
                                <th class="text-center px-4 py-3 font-semibold text-gray-700">Waktu Selesai</th>
                                <th class="text-center px-4 py-3 font-semibold text-gray-700"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($session->attempts->sortByDesc('score') as $ri => $attempt)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-3 py-3 text-center text-gray-400">{{ $ri + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $attempt->mahasiswa->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $attempt->mahasiswa->nim }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : ($attempt->scorePercentage() >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $attempt->score }}/{{ $attempt->total_questions }}
                                            ({{ $attempt->scorePercentage() }}%)
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($attempt->completed_at)
                                            <span class="text-gray-500">{{ $attempt->completed_at->format('d M Y H:i') }}</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-amber-600 font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Sedang mengerjakan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('quiz.result', $attempt) }}" class="text-blue-900 hover:text-blue-700 text-xs font-semibold">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-4 sm:mt-6">
            <a href="{{ route('quizzes.show', $quiz) }}" class="inline-flex items-center gap-2 text-sm text-blue-900 hover:text-blue-700 font-semibold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                Kembali ke Detail Kuis
            </a>
        </div>
    </div>
</x-layouts.app>
