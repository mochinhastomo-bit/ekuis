<x-layouts.app title="Data Mahasiswa - Mochin-Kuis">
<div x-data="mahasiswaPage()" x-cloak>
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h1 class="text-lg sm:text-2xl font-bold text-gray-900">Data Mahasiswa</h1>
            <span class="text-sm text-gray-400 hidden sm:inline">(<span x-text="totalCount"></span> mahasiswa)</span>
        </div>
        <div class="flex gap-2">
            <button @click="showModal = true" class="bg-white border border-gray-300 text-gray-700 px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-gray-50 transition cursor-pointer flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah
            </button>
            <button @click="generateAll()" :disabled="generating" class="bg-blue-900 text-white px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold hover:bg-blue-800 transition cursor-pointer flex items-center gap-1.5 disabled:opacity-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                <span x-text="generating ? 'Generating...' : 'Generate All Token'"></span>
            </button>
        </div>
    </div>

    {{-- Search --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-3 sm:p-4 mb-4 sm:mb-6 shadow-sm">
        <input type="text" x-model="search" placeholder="Cari NIM atau nama..."
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm py-2">
    </div>

    {{-- Mobile: Cards --}}
    <div class="sm:hidden space-y-3">
        @forelse($mahasiswas as $mhs)
            <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow-sm"
                data-mhs-id="{{ $mhs->id }}"
                x-show="matchSearch({{ $mhs->id }})">
                <div class="flex items-start justify-between mb-1">
                    <h3 class="font-semibold text-gray-900 text-sm">{{ $mhs->name }}</h3>
                    <span class="font-mono text-xs bg-blue-50 text-blue-900 px-2 py-0.5 rounded-lg">{{ $mhs->nim }}</span>
                </div>
                <p class="text-xs text-gray-500">{{ $mhs->prodi?->nama ?? '-' }}</p>
                <div class="flex items-center justify-between mt-2">
                    @if($mhs->token)
                        <span class="font-mono text-xs font-bold text-blue-900 bg-blue-50 px-2 py-0.5 rounded-lg"
                            x-text="getToken({{ $mhs->id }}, '{{ $mhs->token }}')"></span>
                    @else
                        <span class="text-xs"
                            :class="getToken({{ $mhs->id }}, '') ? 'font-mono font-bold text-blue-900 bg-blue-50 px-2 py-0.5 rounded-lg' : 'text-gray-400 italic'"
                            x-text="getToken({{ $mhs->id }}, '') || 'Belum ada token'"></span>
                    @endif
                    <button @click="regenerate({{ $mhs->id }})" class="text-gray-400 hover:text-blue-900 transition cursor-pointer" title="Regenerate token">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </button>
                </div>
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
                        <th class="px-4 py-3 text-center font-semibold text-gray-600">Token</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 w-12"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($mahasiswas as $mhs)
                    <tr class="hover:bg-gray-50" x-show="matchSearch({{ $mhs->id }})">
                        <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-mono text-blue-900 font-medium">{{ $mhs->nim }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $mhs->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $mhs->prodi?->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="font-mono font-bold text-blue-900"
                                x-text="getToken({{ $mhs->id }}, '{{ $mhs->token ?? '' }}')"
                                :class="getToken({{ $mhs->id }}, '{{ $mhs->token ?? '' }}') ? 'font-mono font-bold text-blue-900' : 'text-gray-400 text-xs italic'"></span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button @click="regenerate({{ $mhs->id }})" class="text-gray-400 hover:text-blue-900 transition cursor-pointer" title="Regenerate token">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">Tidak ada data mahasiswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Mahasiswa --}}
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" @click="showModal = false"></div>
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md relative z-10"
            x-show="showModal"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <div class="flex items-center justify-between p-4 sm:p-5 border-b border-gray-200">
                <h2 class="font-bold text-gray-900">Tambah Mahasiswa</h2>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form @submit.prevent="storeMahasiswa()" class="p-4 sm:p-5 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                    <input type="text" x-model="form.nim" required placeholder="Masukkan NIM"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                    <p x-show="formErrors.nim" x-text="formErrors.nim" class="mt-1 text-sm text-red-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" x-model="form.name" required placeholder="Masukkan nama lengkap"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                    <p x-show="formErrors.name" x-text="formErrors.name" class="mt-1 text-sm text-red-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                    <select x-model="form.prodi_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-800 focus:ring-blue-800 text-sm">
                        <option value="">-- Pilih Prodi --</option>
                        @foreach($prodis as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" :disabled="submitting" class="flex-1 bg-blue-900 text-white py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition cursor-pointer text-sm disabled:opacity-50">
                        <span x-text="submitting ? 'Menyimpan...' : 'Simpan'"></span>
                    </button>
                    <button type="button" @click="showModal = false" class="px-4 py-2.5 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition text-sm cursor-pointer">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Toast --}}
    <div x-show="toast.show" x-cloak
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-6 right-6 z-50 max-w-sm">
        <div class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg border"
            :class="toast.type === 'error' ? 'bg-red-50 border-red-200 text-red-700' : 'bg-green-50 border-green-200 text-green-700'">
            <svg x-show="toast.type !== 'error'" class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <svg x-show="toast.type === 'error'" class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-medium" x-text="toast.message"></span>
            <button @click="toast.show = false" class="ml-auto text-gray-400 hover:text-gray-600 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function mahasiswaPage() {
    const searchMap = @json($mahasiswas->mapWithKeys(fn ($m) => [$m->id => strtolower($m->name . ' ' . $m->nim)]));

    return {
        search: '',
        showModal: false,
        submitting: false,
        generating: false,
        totalCount: {{ $mahasiswas->count() }},
        tokens: {},
        toast: { show: false, message: '', type: 'success' },
        form: { nim: '', name: '', prodi_id: '' },
        formErrors: {},
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,

        matchSearch(id) {
            if (!this.search) return true;
            const text = searchMap[id] || '';
            return text.includes(this.search.toLowerCase());
        },

        getToken(id, original) {
            return this.tokens[id] || original || '';
        },

        showToast(message, type = 'success') {
            this.toast = { show: true, message, type };
            setTimeout(() => this.toast.show = false, 3000);
        },

        async storeMahasiswa() {
            this.submitting = true;
            this.formErrors = {};
            try {
                const res = await fetch('{{ route("mahasiswa.store") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify(this.form)
                });
                const data = await res.json();
                if (!res.ok) {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(k => this.formErrors[k] = data.errors[k][0]);
                    }
                    return;
                }
                this.showToast(data.message);
                this.showModal = false;
                this.form = { nim: '', name: '', prodi_id: '' };
                this.totalCount++;
                setTimeout(() => location.reload(), 800);
            } catch (e) {
                this.showToast('Terjadi kesalahan.', 'error');
            } finally {
                this.submitting = false;
            }
        },

        async generateAll() {
            this.generating = true;
            try {
                const res = await fetch('{{ route("mahasiswa.tokens.generate-all") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': this.csrfToken, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.tokens) {
                    Object.entries(data.tokens).forEach(([id, token]) => this.tokens[id] = token);
                }
                this.showToast(data.message);
            } catch (e) {
                this.showToast('Terjadi kesalahan.', 'error');
            } finally {
                this.generating = false;
            }
        },

        async regenerate(id) {
            try {
                const res = await fetch(`/mahasiswa/${id}/regenerate-token`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': this.csrfToken, 'Accept': 'application/json' }
                });
                const data = await res.json();
                this.tokens[id] = data.token;
                this.showToast(data.message);
            } catch (e) {
                this.showToast('Terjadi kesalahan.', 'error');
            }
        }
    }
}
</script>
</x-layouts.app>
