<x-layouts.app title="{{ $quiz->title }} - Mochin-Kuis">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 mb-4 sm:mb-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-blue-900" viewBox="0 0 120 120" fill="none">
                            <path d="M60 15L10 40L60 65L110 40L60 15Z" fill="currentColor"/>
                            <path d="M25 48V78C25 78 42 95 60 95C78 95 95 78 95 78V48" stroke="currentColor" stroke-width="5" fill="none"/>
                        </svg>
                        <h1 class="text-lg sm:text-2xl font-bold text-gray-900">{{ $quiz->title }}</h1>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ $quiz->description }}</p>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-medium {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <span class="text-xs sm:text-sm text-gray-500">Kode: <span class="font-mono font-bold text-blue-900 bg-blue-50 px-2 py-0.5 rounded">{{ $quiz->code }}</span></span>
                    </div>
                </div>
                <div class="flex gap-2 shrink-0">
                    <a href="{{ route('quizzes.edit', $quiz) }}" class="bg-white border border-gray-300 text-gray-700 px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-gray-50 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('questions.create', $quiz) }}" class="bg-blue-900 text-white px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold hover:bg-blue-800 transition shadow-sm flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Soal
                    </a>
                </div>
            </div>
        </div>

        {{-- Daftar Soal --}}
        <div class="mb-4 sm:mb-8">
            <div class="flex items-center gap-2 mb-3 sm:mb-4">
                <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-base sm:text-lg font-bold text-gray-900">Daftar Soal ({{ $quiz->questions->count() }})</h2>
            </div>
            @if($quiz->questions->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-200 p-6 sm:p-8 text-center shadow-sm">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">Belum ada soal</p>
                    <p class="text-gray-400 text-sm mt-1">Tambahkan soal pertama untuk kuis ini</p>
                </div>
            @else
                <div class="space-y-2 sm:space-y-3">
                    @foreach($quiz->questions as $index => $question)
                        <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200 p-3 sm:p-4 shadow-sm">
                            <div class="flex items-start justify-between mb-2 gap-2">
                                <div class="flex-1 flex items-start gap-2">
                                    <span class="shrink-0 w-7 h-7 rounded-lg bg-blue-900 text-white flex items-center justify-center text-xs font-bold">{{ $index + 1 }}</span>
                                    <div class="flex-1">
                                        <span class="font-medium text-gray-900 text-sm sm:text-base">{{ $question->question_text }}</span>
                                        <span class="ml-2 text-xs text-gray-400 flex items-center gap-1 inline-flex">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                            </svg>
                                            {{ $question->time_limit }}s
                                        </span>
                                    </div>
                                </div>
                                <div class="flex gap-2 ml-2 shrink-0">
                                    <a href="{{ route('questions.edit', [$quiz, $question]) }}" class="text-xs sm:text-sm text-blue-900 hover:text-blue-700 font-medium">Edit</a>
                                    <form method="POST" action="{{ route('questions.destroy', [$quiz, $question]) }}"
                                        onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs sm:text-sm text-red-600 hover:text-red-800 font-medium cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 sm:gap-2 mt-2 ml-9">
                                @foreach($question->options as $oi => $option)
                                    <div class="text-xs sm:text-sm px-3 py-1.5 rounded-lg flex items-center gap-2 {{ $option->is_correct ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-50 text-gray-600' }}">
                                        <span class="shrink-0 w-5 h-5 rounded flex items-center justify-center text-xs font-semibold {{ $option->is_correct ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-500' }}">{{ chr(65 + $oi) }}</span>
                                        {{ $option->option_text }}
                                        @if($option->is_correct)
                                            <svg class="w-4 h-4 text-green-500 ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Hasil Peserta --}}
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 mb-3 sm:mb-4">
                <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h2 class="text-base sm:text-lg font-bold text-gray-900">Hasil Peserta ({{ $quiz->attempts->count() }})</h2>
            </div>
            @if($quiz->attempts->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-200 p-6 sm:p-8 text-center shadow-sm">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">Belum ada peserta</p>
                    <p class="text-gray-400 text-sm mt-1">Bagikan kode kuis kepada mahasiswa</p>
                </div>
            @else
                {{-- Mobile: Card layout --}}
                <div class="sm:hidden space-y-2">
                    @foreach($quiz->attempts->sortByDesc('score') as $attempt)
                        <a href="{{ route('quiz.result', $attempt) }}" class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex items-center justify-between gap-3 block">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 text-sm truncate">{{ $attempt->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $attempt->user->nim ?? '-' }} &middot; {{ $attempt->completed_at?->format('d M Y') ?? 'Belum selesai' }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="text-lg font-bold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : ($attempt->scorePercentage() >= 50 ? 'text-yellow-600' : 'text-red-600') }}">{{ $attempt->scorePercentage() }}%</span>
                                <p class="text-xs text-gray-400">{{ $attempt->score }}/{{ $attempt->total_questions }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Desktop: Table layout --}}
                <div class="hidden sm:block bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left px-4 py-3 font-semibold text-gray-700">Nama</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-700">NIM</th>
                                <th class="text-center px-4 py-3 font-semibold text-gray-700">Skor</th>
                                <th class="text-center px-4 py-3 font-semibold text-gray-700">Waktu Selesai</th>
                                <th class="text-center px-4 py-3 font-semibold text-gray-700"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($quiz->attempts->sortByDesc('score') as $attempt)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $attempt->user->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $attempt->user->nim ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : ($attempt->scorePercentage() >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $attempt->score }}/{{ $attempt->total_questions }}
                                            ({{ $attempt->scorePercentage() }}%)
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-500">
                                        {{ $attempt->completed_at?->format('d M Y H:i') ?? '-' }}
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
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-blue-900 hover:text-blue-700 font-semibold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.app>
