<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $quizzes = $request->user()->quizzes()
            ->with(['periode', 'prodi', 'matakuliah', 'kelas'])
            ->withCount(['questions', 'attempts'])
            ->latest()
            ->get();

        return view('dosen.dashboard', compact('quizzes'));
    }
}
