<x-layouts.app title="Edit Soal - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Soal</h1>
        <p class="text-gray-500 mb-6">{{ $quiz->title }}</p>

        <form method="POST" action="{{ route('questions.update', [$quiz, $question]) }}"
            x-data="{
                options: @js($question->options->map(fn($o) => ['text' => $o->option_text])->values()),
                correctOption: {{ $question->options->search(fn($o) => $o->is_correct) ?: 0 }},
                addOption() {
                    if (this.options.length < 6) this.options.push({ text: '' });
                },
                removeOption(index) {
                    if (this.options.length > 2) {
                        this.options.splice(index, 1);
                        if (this.correctOption >= this.options.length) this.correctOption = 0;
                    }
                }
            }"
            class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="question_text" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                <textarea name="question_text" id="question_text" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
            </div>

            <div>
                <label for="time_limit" class="block text-sm font-medium text-gray-700 mb-1">Batas Waktu (detik)</label>
                <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', $question->time_limit) }}" min="5" max="300" required
                    class="w-32">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban</label>
                <input type="hidden" name="correct_option" x-model="correctOption">
                <div class="space-y-2">
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex items-center gap-2">
                            <input type="radio" :value="index" x-model="correctOption"
                                name="correct_option_radio"
                                class="text-indigo-600 focus:ring-indigo-500">
                            <input type="text" x-model="option.text"
                                :name="'options[' + index + '][text]'"
                                placeholder="Teks pilihan..."
                                required
                                class="flex-1">
                            <button type="button" @click="removeOption(index)"
                                x-show="options.length > 2"
                                class="text-red-400 hover:text-red-600 px-2">
                                &times;
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="addOption()" x-show="options.length < 6"
                    class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    + Tambah Pilihan
                </button>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('quizzes.show', $quiz) }}" class="px-6 py-2 rounded-lg font-medium text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
