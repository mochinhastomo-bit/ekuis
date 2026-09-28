<x-layouts.app title="Kelola Master Data - Mochin-Kuis">
    <div class="flex items-center gap-2 mb-4 sm:mb-6">
        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
        </svg>
        <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Kelola Master Data</h1>
    </div>

    <div class="grid gap-4 sm:gap-6 sm:grid-cols-2" x-data>
        @foreach([
            ['periodes', 'Periode Akademik', $periodes, 'Contoh: 2026-2027 Genap'],
            ['prodis', 'Program Studi', $prodis, 'Contoh: Teknik Informatika'],
            ['matakuliahs', 'Mata Kuliah', $matakuliahs, 'Contoh: Pemrograman Web'],
            ['kelas', 'Kelas', $kelas, 'Contoh: Malam'],
        ] as [$type, $label, $items, $placeholder])
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-5 shadow-sm">
            <h2 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-900"></span>
                {{ $label }}
                <span class="ml-auto text-xs font-normal text-gray-400">{{ $items->count() }} data</span>
            </h2>

            <form method="POST" action="{{ route('master-data.store', $type) }}" class="flex gap-2 mb-3">
                @csrf
                <input type="text" name="nama" placeholder="{{ $placeholder }}" required
                    class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">
                <button type="submit" class="bg-blue-900 text-white px-3 py-2 rounded-xl hover:bg-blue-800 transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </form>

            @if($items->isEmpty())
                <p class="text-sm text-gray-400 text-center py-3">Belum ada data</p>
            @else
                <ul class="space-y-1.5">
                    @foreach($items as $item)
                    <li class="flex items-center justify-between py-1.5 px-3 rounded-lg hover:bg-gray-50 group">
                        <span class="text-sm text-gray-700">{{ $item->nama }}</span>
                        <form method="POST" action="{{ route('master-data.destroy', [$type, $item->id]) }}"
                            onsubmit="return confirm('Hapus {{ $label }}: {{ $item->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-500 transition cursor-pointer opacity-0 group-hover:opacity-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
        @endforeach
    </div>
</x-layouts.app>
