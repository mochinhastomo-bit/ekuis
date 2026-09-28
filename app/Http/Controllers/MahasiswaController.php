<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('prodi')->orderBy('name');

        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        $mahasiswas = $query->get();
        $prodis = Prodi::orderBy('nama')->get();

        return view('dosen.mahasiswa.index', compact('mahasiswas', 'prodis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:20', 'unique:mahasiswas,nim'],
            'name' => ['required', 'string', 'max:255'],
            'prodi_id' => ['nullable', 'exists:prodis,id'],
        ]);

        $mhs = Mahasiswa::create($validated);
        $mhs->load('prodi');

        return response()->json([
            'message' => "Mahasiswa {$mhs->name} berhasil ditambahkan.",
            'mahasiswa' => [
                'id' => $mhs->id,
                'nim' => $mhs->nim,
                'name' => $mhs->name,
                'token' => $mhs->token,
                'prodi' => $mhs->prodi?->nama ?? '-',
            ],
        ]);
    }

    public function generateAllTokens()
    {
        $count = Mahasiswa::whereNull('token')->count();

        if ($count === 0) {
            return response()->json([
                'message' => 'Semua mahasiswa sudah memiliki token.',
                'tokens' => [],
            ]);
        }

        $tokens = [];
        Mahasiswa::whereNull('token')->each(function ($mhs) use (&$tokens) {
            $token = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $mhs->update(['token' => $token]);
            $tokens[$mhs->id] = $token;
        });

        return response()->json([
            'message' => "Token berhasil digenerate untuk {$count} mahasiswa.",
            'tokens' => $tokens,
        ]);
    }

    public function regenerateToken(Mahasiswa $mahasiswa)
    {
        $token = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        $mahasiswa->update(['token' => $token]);

        return response()->json([
            'message' => "Token {$mahasiswa->name} berhasil diperbarui.",
            'token' => $token,
            'mahasiswa_id' => $mahasiswa->id,
        ]);
    }
}
