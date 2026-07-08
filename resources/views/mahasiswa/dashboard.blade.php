<x-layouts.app title="Dashboard Mahasiswa - Mochin-Kuis">
    {{-- Join Quiz Card --}}
    <div class="bg-gradient-to-r from-blue-900 to-indigo-900 rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-10">
            <svg class="w-48 h-48" viewBox="0 0 200 200" fill="none">
                <circle cx="100" cy="100" r="80" stroke="white" stroke-width="2"/>
                <circle cx="100" cy="100" r="50" stroke="white" stroke-width="1.5"/>
                <circle cx="100" cy="100" r="20" stroke="white" stroke-width="1"/>
            </svg>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                </svg>
                <h1 class="text-2xl font-bold">Ikuti Kuis</h1>
            </div>
            <p class="text-blue-200 mb-6 text-sm">Masukkan kode kuis dari dosen untuk mulai mengerjakan</p>
            <form method="POST" action="{{ route('quiz.join') }}" class="flex gap-3 max-w-lg">
                @csrf
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                    </span>
                    <input type="text" name="code" placeholder="Masukkan kode kuis" required
                        class="!pl-12 w-full rounded-xl border border-gray-200 shadow-sm bg-white text-gray-900 placeholder-gray-400 py-3 uppercase tracking-widest font-semibold text-lg"
                        maxlength="6">
                </div>
                <button type="submit"
                    class="bg-white text-blue-900 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition shadow-sm cursor-pointer flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    Gabung
                </button>
            </form>
            @error('code')
                <p class="mt-3 text-sm text-red-300 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    {{-- History --}}
    <div>
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="text-lg font-bold text-gray-900">Riwayat Kuis</h2>
        </div>

        @if($attempts->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-gray-500 font-medium">Belum ada kuis yang dikerjakan</p>
                <p class="text-gray-400 text-sm mt-1">Masukkan kode kuis dari dosen untuk memulai</p>
            </div>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($attempts as $attempt)
                    <a href="{{ route('quiz.result', $attempt) }}"
                        class="bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-md hover:border-blue-200 transition group block">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="font-semibold text-gray-900 group-hover:text-blue-900 transition text-sm leading-tight flex-1 mr-3">
                                {{ $attempt->quiz->title }}
                            </h3>
                            <span class="text-2xl font-bold {{ $attempt->scorePercentage() >= 70 ? 'text-green-600' : ($attempt->scorePercentage() >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ $attempt->scorePercentage() }}%
                            </span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden mb-3">
                            <div class="h-full rounded-full {{ $attempt->scorePercentage() >= 70 ? 'bg-green-500' : ($attempt->scorePercentage() >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                style="width: {{ $attempt->scorePercentage() }}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                </svg>
                                {{ $attempt->score }}/{{ $attempt->total_questions }} benar
                            </span>
                            <span>{{ $attempt->completed_at?->format('d M Y') ?? 'Belum selesai' }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
