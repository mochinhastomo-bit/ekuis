<x-layouts.app title="{{ $quiz->title }} - Mochin-Kuis">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $quiz->title }}</h1>
                <p class="text-gray-500 mt-1">{{ $quiz->description }}</p>
                <div class="flex items-center gap-3 mt-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                        {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <span class="text-sm text-gray-500">Kode: <span class="font-mono font-bold text-indigo-600">{{ $quiz->code }}</span></span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('quizzes.edit', $quiz) }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition">
                    Edit Kuis
                </a>
                <a href="{{ route('questions.create', $quiz) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                    + Tambah Soal
                </a>
            </div>
        </div>

        {{-- Daftar Soal --}}
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Daftar Soal ({{ $quiz->questions->count() }})</h2>
            @if($quiz->questions->isEmpty())
                <div class="bg-white rounded-xl border border-gray-200 p-8 text-center">
                    <p class="text-gray-500">Belum ada soal. Tambahkan soal pertama.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($quiz->questions as $index => $question)
                        <div class="bg-white rounded-xl border border-gray-200 p-4">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <span class="text-sm font-medium text-gray-400 mr-2">#{{ $index + 1 }}</span>
                                    <span class="font-medium text-gray-900">{{ $question->question_text }}</span>
                                    <span class="ml-2 text-xs text-gray-400">{{ $question->time_limit }} detik</span>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <a href="{{ route('questions.edit', [$quiz, $question]) }}" class="text-sm text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form method="POST" action="{{ route('questions.destroy', [$quiz, $question]) }}"
                                        onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                @foreach($question->options as $option)
                                    <div class="text-sm px-3 py-1.5 rounded {{ $option->is_correct ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-50 text-gray-600' }}">
                                        {{ $option->option_text }}
                                        @if($option->is_correct)
                                            <span class="text-green-500 ml-1">&#10003;</span>
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
        <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Hasil Peserta ({{ $quiz->attempts->count() }})</h2>
            @if($quiz->attempts->isEmpty())
                <div class="bg-white rounded-xl border border-gray-200 p-8 text-center">
                    <p class="text-gray-500">Belum ada peserta yang mengerjakan.</p>
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left px-4 py-3 font-medium text-gray-700">Nama</th>
                                <th class="text-left px-4 py-3 font-medium text-gray-700">NIM</th>
                                <th class="text-center px-4 py-3 font-medium text-gray-700">Skor</th>
                                <th class="text-center px-4 py-3 font-medium text-gray-700">Waktu Selesai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($quiz->attempts->sortByDesc('score') as $attempt)
                                <tr>
                                    <td class="px-4 py-3">{{ $attempt->user->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $attempt->user->nim ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-semibold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $attempt->score }}/{{ $attempt->total_questions }}
                                            ({{ $attempt->scorePercentage() }}%)
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-500">
                                        {{ $attempt->completed_at?->format('d M Y H:i') ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-800">&larr; Kembali ke Dashboard</a>
        </div>
    </div>
</x-layouts.app>
