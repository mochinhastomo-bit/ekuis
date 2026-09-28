<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'mahasiswa')->orderBy('prodi')->orderBy('nim');

        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $mahasiswas = $query->paginate(50)->withQueryString();
        $prodis = User::where('role', 'mahasiswa')->distinct()->pluck('prodi')->sort()->values();

        return view('dosen.mahasiswa.index', compact('mahasiswas', 'prodis'));
    }
}
