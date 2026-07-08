<x-layouts.app title="Hasil Kuis - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        {{-- Score Summary --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-8 text-center mb-4 sm:mb-8 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 {{ $attempt->scorePercentage() >= 70 ? 'bg-green-500' : ($attempt->scorePercentage() >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}"></div>

            <div class="flex items-center justify-center gap-2 mb-1">
                <svg class="w-5 h-5 text-blue-900" viewBox="0 0 120 120" fill="none">
                    <path d="M60 15L10 40L60 65L110 40L60 15Z" fill="currentColor"/>
                    <path d="M25 48V78C25 78 42 95 60 95C78 95 95 78 95 78V48" stroke="currentColor" stroke-width="5" fill="none"/>
                </svg>
                <h1 class="text-sm sm:text-lg font-bold text-gray-900">{{ $attempt->quiz->title }}</h1>
            </div>
            <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6">Hasil pengerjaan kuis</p>

            <div class="inline-flex items-center justify-center w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 mb-3 sm:mb-4
                {{ $attempt->scorePercentage() >= 70 ? 'border-green-500' : ($attempt->scorePercentage() >= 50 ? 'border-yellow-500' : 'border-red-500') }}">
                <div>
                    <div class="text-3xl sm:text-4xl font-bold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : ($attempt->scorePercentage() >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $attempt->scorePercentage() }}%
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 sm:gap-4 mt-4 sm:mt-6">
                <div class="bg-gray-50 rounded-xl p-2 sm:p-3">
                    <p class="text-xl sm:text-2xl font-bold text-green-600">{{ $attempt->score }}</p>
                    <p class="text-xs text-gray-500">Benar</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-2 sm:p-3">
                    <p class="text-xl sm:text-2xl font-bold text-red-600">{{ $attempt->total_questions - $attempt->score }}</p>
                    <p class="text-xs text-gray-500">Salah</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-2 sm:p-3">
                    <p class="text-xl sm:text-2xl font-bold text-blue-900">{{ $attempt->total_questions }}</p>
                    <p class="text-xs text-gray-500">Total Soal</p>
                </div>
            </div>

            @if($attempt->completed_at && $attempt->started_at)
                <p class="text-sm text-gray-400 mt-4 flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Durasi: {{ $attempt->started_at->diffForHumans($attempt->completed_at, true) }}
                </p>
            @endif
        </div>

        {{-- Detail Jawaban --}}
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <h2 class="text-lg font-bold text-gray-900">Detail Jawaban</h2>
        </div>

        <div class="space-y-2 sm:space-y-3">
            @foreach($attempt->answers->sortBy('question.order') as $index => $answer)
                <div class="bg-white rounded-xl sm:rounded-2xl border-2 {{ $answer->is_correct ? 'border-green-200' : 'border-red-200' }} p-3 sm:p-5 shadow-sm">
                    <div class="flex items-start gap-2 sm:gap-3">
                        <span class="shrink-0 w-7 h-7 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl flex items-center justify-center text-xs sm:text-sm font-bold {{ $answer->is_correct ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            @if($answer->is_correct)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @endif
                        </span>
                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <p class="font-medium text-gray-900 mb-1 sm:mb-2 leading-relaxed text-sm sm:text-base">
                                    <span class="text-gray-400 text-sm mr-1">{{ $index + 1 }}.</span>
                                    {{ $answer->question->question_text }}
                                </p>
                                <span class="shrink-0 text-xs text-gray-400 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                    </svg>
                                    {{ $answer->time_spent }}s
                                </span>
                            </div>
                            <div class="text-xs sm:text-sm space-y-1">
                                @if($answer->option)
                                    <p class="flex items-start gap-2">
                                        <span class="text-gray-500 shrink-0">Jawaban:</span>
                                        <span class="{{ $answer->is_correct ? 'text-green-600 font-semibold' : 'text-red-600 line-through' }}">
                                            {{ $answer->option->option_text }}
                                        </span>
                                    </p>
                                @else
                                    <p class="text-gray-400 italic flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Tidak dijawab (waktu habis)
                                    </p>
                                @endif
                                @if(! $answer->is_correct)
                                    @php
                                        $correctOption = $answer->question->options->firstWhere('is_correct', true);
                                    @endphp
                                    @if($correctOption)
                                        <p class="flex items-start gap-2">
                                            <span class="text-gray-500 shrink-0">Benar:</span>
                                            <span class="text-green-600 font-semibold">{{ $correctOption->option_text }}</span>
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-blue-900 hover:text-blue-700 font-semibold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.app>
