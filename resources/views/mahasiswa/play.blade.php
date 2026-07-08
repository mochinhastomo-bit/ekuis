<x-layouts.app title="Mengerjakan Kuis - Mochin-Kuis">
    <div class="max-w-2xl mx-auto"
        x-data="{
            timeLeft: {{ $question->time_limit }},
            totalTime: {{ $question->time_limit }},
            selectedOption: null,
            submitting: false,
            interval: null,

            init() {
                this.interval = setInterval(() => {
                    this.timeLeft--;
                    if (this.timeLeft <= 0) {
                        clearInterval(this.interval);
                        this.submitAnswer();
                    }
                }, 1000);
            },

            get timerPercent() {
                return (this.timeLeft / this.totalTime) * 100;
            },

            get timerColor() {
                if (this.timeLeft <= 5) return 'bg-red-500';
                if (this.timeLeft <= 10) return 'bg-yellow-500';
                return 'bg-blue-600';
            },

            get timerTextColor() {
                if (this.timeLeft <= 5) return 'text-red-600';
                if (this.timeLeft <= 10) return 'text-yellow-600';
                return 'text-blue-900';
            },

            async submitAnswer() {
                if (this.submitting) return;
                this.submitting = true;
                clearInterval(this.interval);

                const timeSpent = this.totalTime - this.timeLeft;

                try {
                    const response = await fetch('{{ route('quiz.answer', [$quiz, $attempt]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            question_id: {{ $question->id }},
                            option_id: this.selectedOption,
                            time_spent: timeSpent,
                        }),
                    });

                    const data = await response.json();
                    window.location.href = data.redirect;
                } catch (e) {
                    this.submitting = false;
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            }
        }">

        {{-- Header Card --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-5 mb-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg font-bold text-gray-900">{{ $quiz->title }}</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Soal <span class="font-semibold text-blue-900">{{ $currentNumber }}</span> dari <span class="font-semibold">{{ $totalQuestions }}</span></p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full border-4 flex items-center justify-center"
                        :class="timeLeft <= 5 ? 'border-red-500' : (timeLeft <= 10 ? 'border-yellow-500' : 'border-blue-900')">
                        <span class="text-xl font-bold" :class="timerTextColor" x-text="timeLeft"></span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">detik</p>
                </div>
            </div>

            {{-- Progress bar --}}
            <div class="mt-4 flex items-center gap-3">
                <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-900 rounded-full transition-all" style="width: {{ ($currentNumber - 1) / $totalQuestions * 100 }}%"></div>
                </div>
                <span class="text-xs text-gray-400 font-medium">{{ round(($currentNumber - 1) / $totalQuestions * 100) }}%</span>
            </div>
        </div>

        {{-- Timer bar --}}
        <div class="w-full h-1.5 bg-gray-200 rounded-full mb-6 overflow-hidden">
            <div class="h-full rounded-full transition-all duration-1000 ease-linear"
                :class="timerColor"
                :style="'width: ' + timerPercent + '%'">
            </div>
        </div>

        {{-- Question --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-6 shadow-sm">
            <div class="flex items-start gap-3">
                <span class="shrink-0 w-8 h-8 rounded-lg bg-blue-900 text-white flex items-center justify-center text-sm font-bold">{{ $currentNumber }}</span>
                <p class="text-lg text-gray-900 font-medium leading-relaxed">{{ $question->question_text }}</p>
            </div>
        </div>

        {{-- Options --}}
        <div class="space-y-3 mb-6">
            @foreach($question->options as $i => $option)
                <button type="button"
                    @click="selectedOption = {{ $option->id }}"
                    :class="selectedOption === {{ $option->id }}
                        ? 'border-blue-800 bg-blue-50 ring-2 ring-blue-200'
                        : 'border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300'"
                    class="w-full text-left p-4 rounded-2xl border-2 transition cursor-pointer group"
                    :disabled="submitting">
                    <div class="flex items-center gap-3">
                        <span class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-semibold transition"
                            :class="selectedOption === {{ $option->id }}
                                ? 'bg-blue-900 text-white'
                                : 'bg-gray-100 text-gray-600 group-hover:bg-gray-200'">
                            {{ chr(65 + $i) }}
                        </span>
                        <span class="text-gray-900">{{ $option->option_text }}</span>
                    </div>
                </button>
            @endforeach
        </div>

        {{-- Submit --}}
        <button @click="submitAnswer()" :disabled="submitting || !selectedOption"
            class="w-full bg-blue-900 text-white py-3.5 rounded-2xl font-semibold hover:bg-blue-800 transition disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 shadow-sm">
            <span x-show="!submitting" class="flex items-center gap-2">
                Jawab
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </span>
            <span x-show="submitting" x-cloak class="flex items-center gap-2">
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Mengirim...
            </span>
        </button>
    </div>
</x-layouts.app>
