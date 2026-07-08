<x-layouts.app title="Dashboard Dosen - Mochin-Kuis">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Kuis Saya</h1>
        <a href="{{ route('quizzes.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
            + Buat Kuis
        </a>
    </div>

    @if($quizzes->isEmpty())
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <p class="text-gray-500">Belum ada kuis. Mulai buat kuis pertama Anda!</p>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($quizzes as $quiz)
                <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-semibold text-gray-900">{{ $quiz->title }}</h3>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mb-3">{{ Str::limit($quiz->description, 80) }}</p>
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                        <span>{{ $quiz->questions_count }} soal</span>
                        <span>{{ $quiz->attempts_count }} peserta</span>
                        <span class="font-mono bg-gray-100 px-2 py-0.5 rounded text-xs">{{ $quiz->code }}</span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('quizzes.show', $quiz) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Detail</a>
                        <a href="{{ route('quizzes.edit', $quiz) }}" class="text-sm text-gray-600 hover:text-gray-800 font-medium">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layouts.app>
