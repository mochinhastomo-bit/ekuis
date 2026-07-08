<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isDosen()) {
            $quizzes = $user->quizzes()->withCount(['questions', 'attempts'])->latest()->get();
            return view('dosen.dashboard', compact('quizzes'));
        }

        $attempts = $user->quizAttempts()->with('quiz')->latest()->get();
        return view('mahasiswa.dashboard', compact('attempts'));
    }
}
