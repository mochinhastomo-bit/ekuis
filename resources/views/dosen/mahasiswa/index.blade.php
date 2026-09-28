<x-layouts.app title="Data Mahasiswa - Mochin-Kuis">
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Data Mahasiswa</h1>
            <span class="text-sm text-gray-400 hidden sm:inline">({{ $mahasiswas->total() }} mahasiswa)</span>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-3 sm:p-4 mb-4 sm:mb-6 shadow-sm space-y-2">
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIM atau nama..."
                class="w-full sm:flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">
            <select name="prodi_id" class="w-full sm:w-auto rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">
                <option value="">Semua Prodi</option>
                @foreach($prodis as $p)
                    <option value="{{ $p->id }}" {{ request('prodi_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            <select name="quiz_id" class="w-full sm:flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">
                <option value="">Pilih Kuis (untuk lihat Token)</option>
                @foreach($quizzes as $q)
                    <option value="{{ $q->id }}" {{ request('quiz_id') == $q->id ? 'selected' : '' }}>{{ $q->title }} ({{ $q->code }})</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-xl font-semibold hover:bg-blue-800 transition cursor-pointer text-sm shrink-0">
                Filter
            </button>
            @if(request('search') || request('prodi_id') || request('quiz_id'))
                <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition text-sm text-center shrink-0">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Token Actions --}}
    @if($selectedQuiz)
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-3 sm:p-4 mb-4 sm:mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div>
                    <p class="text-sm font-semibold text-blue-900">Token: {{ $selectedQuiz->title }} <span class="font-mono bg-white px-2 py-0.5 rounded text-xs">{{ $selectedQuiz->code }}</span></p>
                    <p class="text-xs text-blue-700 mt-0.5">{{ $tokens->count() }} mahasiswa sudah punya token</p>
                </div>
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('mahasiswa.tokens.generate', $selectedQuiz) }}">
                        @csrf
                        @if(request('prodi_id'))
                            <input type="hidden" name="prodi_id" value="{{ request('prodi_id') }}">
                        @endif
                        <button type="submit" class="bg-blue-900 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-blue-800 transition cursor-pointer flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            Generate Token{{ request('prodi_id') ? ' (Prodi terpilih)' : ' (Semua)' }}
                        </button>
                    </form>
                    @if($tokens->isNotEmpty())
                        <form method="POST" action="{{ route('mahasiswa.tokens.clear', $selectedQuiz) }}"
                            onsubmit="return confirm('Hapus semua token untuk kuis ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-medium cursor-pointer bg-white border border-red-200 px-3 py-1.5 rounded-xl">Hapus Token</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Mobile: Cards --}}
    <div class="sm:hidden space-y-3">
        @forelse($mahasiswas as $mhs)
            <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow-sm">
                <div class="flex items-start justify-between mb-1">
                    <h3 class="font-semibold text-gray-900 text-sm">{{ $mhs->name }}</h3>
                    <span class="font-mono text-xs bg-blue-50 text-blue-900 px-2 py-0.5 rounded-lg">{{ $mhs->nim }}</span>
                </div>
                <p class="text-xs text-gray-500">{{ $mhs->prodi?->nama ?? '-' }}</p>
                @if($selectedQuiz && $tokens->has($mhs->id))
                    <p class="mt-1.5 font-mono text-xs font-bold text-blue-900 bg-blue-50 px-2 py-0.5 rounded-lg inline-block">{{ $tokens[$mhs->id] }}</p>
                @elseif($selectedQuiz)
                    <p class="mt-1.5 text-xs text-gray-400 italic">Belum ada token</p>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center">
                <p class="text-gray-500 font-medium">Tidak ada data mahasiswa</p>
            </div>
        @endforelse
    </div>

    {{-- Desktop: Table --}}
    <div class="hidden sm:block bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 w-12">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">NIM</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Program Studi</th>
                        @if($selectedQuiz)
                            <th class="px-4 py-3 text-center font-semibold text-gray-600">Token</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($mahasiswas as $mhs)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $mahasiswas->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-3 font-mono text-blue-900 font-medium">{{ $mhs->nim }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $mhs->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $mhs->prodi?->nama ?? '-' }}</td>
                        @if($selectedQuiz)
                            <td class="px-4 py-3 text-center">
                                @if($tokens->has($mhs->id))
                                    <span class="font-mono font-bold text-blue-900">{{ $tokens[$mhs->id] }}</span>
                                @else
                                    <span class="text-gray-400 text-xs italic">-</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $selectedQuiz ? 5 : 4 }}" class="px-4 py-8 text-center text-gray-500">Tidak ada data mahasiswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($mahasiswas->hasPages())
        <div class="mt-4">
            {{ $mahasiswas->links() }}
        </div>
    @endif
</x-layouts.app>
