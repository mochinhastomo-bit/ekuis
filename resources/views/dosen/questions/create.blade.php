<x-layouts.app title="Tambah Soal - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Tambah Soal</h1>
            </div>
            <p class="text-xs sm:text-sm text-gray-500">{{ $quiz->title }}</p>
        </div>

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
            class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 space-y-4 shadow-sm">
            @csrf

            <div>
                <label for="question_text" class="block text-sm font-medium text-gray-700 mb-1.5">Pertanyaan</label>
                <textarea name="question_text" id="question_text" rows="3" required
                    placeholder="Tulis pertanyaan di sini..."
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">{{ old('question_text') }}</textarea>
                @error('question_text')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="time_limit" class="block text-sm font-medium text-gray-700 mb-1.5">Batas Waktu (detik)</label>
                <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', 30) }}" min="5" max="300" required
                    class="w-32 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
                @error('time_limit')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban</label>
                <p class="text-xs text-gray-400 mb-3">Pilih radio button untuk menandai jawaban yang benar</p>
                <input type="hidden" name="correct_option" x-model="correctOption">
                <div class="space-y-2">
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex items-center gap-2">
                            <input type="radio" :value="index" x-model="correctOption"
                                name="correct_option_radio"
                                class="text-blue-900 focus:ring-blue-800"
                                :title="'Tandai sebagai jawaban benar'">
                            <span class="shrink-0 w-6 h-6 rounded flex items-center justify-center text-xs font-semibold bg-gray-100 text-gray-600" x-text="String.fromCharCode(65 + index)"></span>
                            <input type="text" x-model="option.text"
                                :name="'options[' + index + '][text]'"
                                placeholder="Teks pilihan..."
                                required
                                class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                            <button type="button" @click="removeOption(index)"
                                x-show="options.length > 2"
                                class="text-red-400 hover:text-red-600 px-2 cursor-pointer" title="Hapus pilihan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="addOption()" x-show="options.length < 6"
                    class="mt-3 text-sm text-blue-900 hover:text-blue-700 font-semibold cursor-pointer flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Pilihan
                </button>
                @error('options')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('correct_option')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 sm:gap-3 pt-2">
                <button type="submit" class="bg-blue-900 text-white px-5 sm:px-6 py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer text-sm">
                    Simpan Soal
                </button>
                <a href="{{ route('quizzes.show', $quiz) }}" class="px-5 sm:px-6 py-2.5 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
