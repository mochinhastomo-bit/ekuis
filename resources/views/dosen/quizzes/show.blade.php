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

                    <div class="flex flex-wrap items-center gap-2 mt-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-medium {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <span class="text-xs text-gray-500">Kode: <span class="font-mono font-bold text-blue-900 bg-blue-50 px-2 py-0.5 rounded">{{ $quiz->code }}</span></span>
                    </div>

                    @if($quiz->periode || $quiz->prodi || $quiz->matakuliah || $quiz->kelas)
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs text-gray-500">
                        @if($quiz->periode)
                            <span>Periode: <strong class="text-gray-700">{{ $quiz->periode->nama }}</strong></span>
                        @endif
                        @if($quiz->prodi)
                            <span>Prodi: <strong class="text-gray-700">{{ $quiz->prodi->nama }}</strong></span>
                        @endif
                        @if($quiz->matakuliah)
                            <span>MK: <strong class="text-gray-700">{{ $quiz->matakuliah->nama }}</strong></span>
                        @endif
                        @if($quiz->kelas)
                            <span>Kelas: <strong class="text-gray-700">{{ $quiz->kelas->nama }}</strong></span>
                        @endif
                    </div>
                    @endif
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

        {{-- Sesi Kuis --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-5 mb-4 sm:mb-6 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="font-bold text-gray-900 text-sm sm:text-base">Sesi Kuis</h2>
                @if($activeSession)
                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-medium bg-green-100 text-green-800 animate-pulse">Sesi Aktif</span>
                @endif
            </div>

            @if($activeSession)
                <div class="bg-green-50 border border-green-200 rounded-xl p-3 sm:p-4 mb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-green-900 text-sm">{{ $activeSession->name }}</p>
                            <p class="text-xs text-green-700 mt-0.5">Dimulai: {{ $activeSession->started_at->format('d M Y H:i') }} &middot; {{ $activeSession->attempts_count }} peserta</p>
                        </div>
                        <form method="POST" action="{{ route('quizzes.sessions.end', [$quiz, $activeSession]) }}"
                            onsubmit="return confirm('Akhiri sesi ini? Mahasiswa tidak bisa lagi mengerjakan kuis di sesi ini.')">
                            @csrf
                            <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-800 bg-white border border-red-200 px-3 py-1.5 rounded-lg cursor-pointer">Akhiri Sesi</button>
                        </form>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('quizzes.sessions.start', $quiz) }}" class="flex flex-col sm:flex-row gap-2">
                @csrf
                <input type="text" name="name" placeholder="Nama sesi (misal: Sesi 1 - Pagi)" required
                    class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">
                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-800 transition cursor-pointer flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Mulai Sesi Baru
                </button>
            </form>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            {{-- Daftar sesi sebelumnya --}}
            @if($quiz->sessions->where('is_active', false)->isNotEmpty())
                <div class="mt-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Riwayat Sesi</h3>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($quiz->sessions->where('is_active', false) as $session)
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl px-3 py-2">
                                <div>
                                    <p class="font-medium text-gray-900 text-sm">{{ $session->name }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $session->started_at?->format('d M Y H:i') }}
                                        @if($session->ended_at) &mdash; {{ $session->ended_at->format('H:i') }} @endif
                                        &middot; {{ $session->attempts_count }} peserta
                                    </p>
                                </div>
                                <a href="{{ route('quizzes.sessions.results', [$quiz, $session]) }}" class="text-xs text-blue-900 font-semibold hover:text-blue-700">Lihat Nilai</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Token Mahasiswa --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-5 mb-4 sm:mb-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <h2 class="font-bold text-gray-900 text-sm sm:text-base">Token Mahasiswa ({{ $quiz->tokens->count() }})</h2>
                </div>
                @if($quiz->tokens->isNotEmpty())
                    <form method="POST" action="{{ route('quizzes.tokens.clear', $quiz) }}"
                        onsubmit="return confirm('Hapus semua token?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-medium cursor-pointer bg-red-50 px-3 py-1.5 rounded-lg">Hapus Semua</button>
                    </form>
                @endif
            </div>
            <p class="text-xs text-gray-500 mb-3">Generate token dari master mahasiswa. Token bisa dipakai berulang di setiap sesi kuis.</p>

            @error('prodi_id')
                <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <form method="POST" action="{{ route('quizzes.tokens.generate', $quiz) }}" class="flex flex-col sm:flex-row gap-2 mb-4">
                @csrf
                <select name="prodi_id" class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                    <option value="">Semua Prodi</option>
                    @php $prodiList = \App\Models\Prodi::orderBy('nama')->get(); @endphp
                    @foreach($prodiList as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-800 transition cursor-pointer flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Generate Token
                </button>
            </form>

            @if($quiz->tokens->isNotEmpty())
                {{-- Search token --}}
                <div class="mb-3" x-data="{ search: '' }">
                    <input type="text" x-model="search" placeholder="Cari nama atau NIM..."
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">

                    {{-- Mobile: Card layout --}}
                    <div class="sm:hidden space-y-2 max-h-64 overflow-y-auto mt-2">
                        @foreach($quiz->tokens->sortBy('mahasiswa.name') as $token)
                            <div class="bg-gray-50 rounded-xl p-3 flex items-center justify-between"
                                x-show="!search || '{{ strtolower($token->mahasiswa->name . ' ' . $token->mahasiswa->nim) }}'.includes(search.toLowerCase())">
                                <div class="min-w-0 flex-1">
                                    <p class="font-medium text-gray-900 text-sm truncate">{{ $token->mahasiswa->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $token->mahasiswa->nim }}</p>
                                </div>
                                <span class="font-mono text-sm font-bold text-blue-900 shrink-0 ml-3">{{ $token->token }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Desktop: Table layout --}}
                    <div class="hidden sm:block overflow-x-auto rounded-xl border border-gray-200 max-h-80 overflow-y-auto mt-2">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0">
                                <tr>
                                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Nama</th>
                                    <th class="text-left px-4 py-2 font-semibold text-gray-700">NIM</th>
                                    <th class="text-center px-4 py-2 font-semibold text-gray-700">Token</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($quiz->tokens->sortBy('mahasiswa.name') as $token)
                                    <tr x-show="!search || '{{ strtolower($token->mahasiswa->name . ' ' . $token->mahasiswa->nim) }}'.includes(search.toLowerCase())">
                                        <td class="px-4 py-2 text-gray-900">{{ $token->mahasiswa->name }}</td>
                                        <td class="px-4 py-2 text-gray-500">{{ $token->mahasiswa->nim }}</td>
                                        <td class="px-4 py-2 text-center font-mono font-bold text-blue-900">{{ $token->token }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
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
