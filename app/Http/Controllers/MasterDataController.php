<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Periode;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    private const MODELS = [
        'periodes' => [Periode::class, 'Periode Akademik'],
        'prodis' => [Prodi::class, 'Program Studi'],
        'matakuliahs' => [Matakuliah::class, 'Mata Kuliah'],
    ];

    public function index()
    {
        $data = [];
        foreach (self::MODELS as $key => [$modelClass, $label]) {
            $data[$key] = $modelClass::orderBy('nama')->get();
        }

        return view('dosen.master-data.index', [
            'periodes' => $data['periodes'],
            'prodis' => $data['prodis'],
            'matakuliahs' => $data['matakuliahs'],
        ]);
    }

    public function store(Request $request, string $type)
    {
        abort_unless(isset(self::MODELS[$type]), 404);

        $request->validate(['nama' => ['required', 'string', 'max:255']]);

        [$modelClass, $label] = self::MODELS[$type];
        $modelClass::create(['nama' => $request->nama]);

        return back()->with('success', "{$label} berhasil ditambahkan.");
    }

    public function destroy(string $type, int $id)
    {
        abort_unless(isset(self::MODELS[$type]), 404);

        [$modelClass, $label] = self::MODELS[$type];
        $item = $modelClass::findOrFail($id);
        $item->delete();

        return back()->with('success', "{$label} berhasil dihapus.");
    }
}
