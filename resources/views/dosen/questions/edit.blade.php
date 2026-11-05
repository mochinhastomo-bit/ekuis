<x-layouts.app title="Edit Soal - Mochin-Kuis">
    <div class="max-w-2xl mx-auto">
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Edit Soal</h1>
            </div>
            <p class="text-xs sm:text-sm text-gray-500">{{ $quiz->title }}</p>
        </div>

        <form method="POST" action="{{ route('questions.update', [$quiz, $question]) }}" enctype="multipart/form-data"
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
            class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 space-y-4 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label for="question_text" class="block text-sm font-medium text-gray-700 mb-1.5">Pertanyaan</label>
                <textarea name="question_text" id="question_text" rows="3" required
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">{{ old('question_text', $question->question_text) }}</textarea>
            </div>

            <div x-data="{ preview: null, removeImage: false }">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar (opsional)</label>
                @if($question->image)
                    <div class="mb-2" x-show="!removeImage">
                        <img src="{{ asset('storage/' . $question->image) }}" class="max-h-48 rounded-xl border border-gray-200">
                        <button type="button" @click="removeImage = true"
                            class="mt-1 text-xs text-red-600 hover:text-red-800 font-medium cursor-pointer">Hapus gambar</button>
                    </div>
                    <input type="hidden" name="remove_image" :value="removeImage ? '1' : '0'">
                @endif
                <div class="flex items-center gap-3">
                    <label class="cursor-pointer bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 transition inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $question->image ? 'Ganti Gambar' : 'Pilih Gambar' }}
                        <input type="file" name="image" accept="image/*" class="hidden"
                            @change="if ($event.target.files[0]) { const r = new FileReader(); r.onload = e => preview = e.target.result; r.readAsDataURL($event.target.files[0]); removeImage = false; }">
                    </label>
                    <span class="text-xs text-gray-400">Maks 2MB (JPG, PNG)</span>
                </div>
                <template x-if="preview">
                    <img :src="preview" class="mt-2 max-h-48 rounded-xl border border-gray-200">
                </template>
                @error('image')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="time_limit" class="block text-sm font-medium text-gray-700 mb-1.5">Batas Waktu (detik)</label>
                <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', $question->time_limit) }}" min="5" max="300" required
                    class="w-32 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban</label>
                <input type="hidden" name="correct_option" x-model="correctOption">
                <div class="space-y-2">
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex items-center gap-2">
                            <input type="radio" :value="index" x-model="correctOption"
                                name="correct_option_radio"
                                class="text-blue-900 focus:ring-blue-800">
                            <span class="shrink-0 w-6 h-6 rounded flex items-center justify-center text-xs font-semibold bg-gray-100 text-gray-600" x-text="String.fromCharCode(65 + index)"></span>
                            <input type="text" x-model="option.text"
                                :name="'options[' + index + '][text]'"
                                placeholder="Teks pilihan..."
                                required
                                class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                            <button type="button" @click="removeOption(index)"
                                x-show="options.length > 2"
                                class="text-red-400 hover:text-red-600 px-2 cursor-pointer">
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
            </div>

            <div class="flex gap-2 sm:gap-3 pt-2">
                <button type="submit" class="bg-blue-900 text-white px-5 sm:px-6 py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition shadow-sm cursor-pointer text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('quizzes.show', $quiz) }}" class="px-5 sm:px-6 py-2.5 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
