<x-layouts.app title="Tambah Soal - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Soal</h1>
        <p class="text-gray-500 mb-6">{{ $quiz->title }}</p>

        <form method="POST" action="{{ route('questions.store', $quiz) }}"
            x-data="{
                options: [
                    { text: '' },
                    { text: '' },
                    { text: '' },
                    { text: '' }
                ],
                correctOption: 0,
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

            <div>
                <label for="question_text" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                <textarea name="question_text" id="question_text" rows="3" required>{{ old('question_text') }}</textarea>
                @error('question_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="time_limit" class="block text-sm font-medium text-gray-700 mb-1">Batas Waktu (detik)</label>
                <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', 30) }}" min="5" max="300" required
                    class="w-32">
                @error('time_limit')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban</label>
                <input type="hidden" name="correct_option" x-model="correctOption">
                <div class="space-y-2">
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex items-center gap-2">
                            <input type="radio" :value="index" x-model="correctOption"
                                name="correct_option_radio"
                                class="text-indigo-600 focus:ring-indigo-500"
                                :title="'Tandai sebagai jawaban benar'">
                            <input type="text" x-model="option.text"
                                :name="'options[' + index + '][text]'"
                                placeholder="Teks pilihan..."
                                required
                                class="flex-1">
                            <button type="button" @click="removeOption(index)"
                                x-show="options.length > 2"
                                class="text-red-400 hover:text-red-600 px-2" title="Hapus pilihan">
                                &times;
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="addOption()" x-show="options.length < 6"
                    class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    + Tambah Pilihan
                </button>
                @error('options')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('correct_option')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                    Simpan Soal
                </button>
                <a href="{{ route('quizzes.show', $quiz) }}" class="px-6 py-2 rounded-lg font-medium text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
