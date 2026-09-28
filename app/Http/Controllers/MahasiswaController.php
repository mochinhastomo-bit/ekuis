<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Quiz;
use App\Models\QuizToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('prodi')->orderBy('name');

        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $selectedQuiz = null;
        $tokens = collect();

        if ($request->filled('quiz_id')) {
            $selectedQuiz = Quiz::where('id', $request->quiz_id)
                ->where('user_id', auth()->id())
                ->first();

            if ($selectedQuiz) {
                $tokens = QuizToken::where('quiz_id', $selectedQuiz->id)
                    ->pluck('token', 'mahasiswa_id');
            }
        }

        $mahasiswas = $query->paginate(50)->withQueryString();
        $prodis = Prodi::orderBy('nama')->get();
        $quizzes = auth()->user()->quizzes()->orderBy('title')->get();

        return view('dosen.mahasiswa.index', compact('mahasiswas', 'prodis', 'quizzes', 'selectedQuiz', 'tokens'));
    }

    public function generateTokens(Request $request, Quiz $quiz)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);

        $request->validate([
            'prodi_id' => ['nullable', 'exists:prodis,id'],
        ]);

        $query = Mahasiswa::query();
        if ($request->prodi_id) {
            $query->where('prodi_id', $request->prodi_id);
        }
        $students = $query->get();

        if ($students->isEmpty()) {
            return back()->withErrors(['prodi_id' => 'Tidak ada mahasiswa ditemukan.']);
        }

        $generated = 0;
        foreach ($students as $student) {
            $exists = QuizToken::where('quiz_id', $quiz->id)
                ->where('mahasiswa_id', $student->id)
                ->exists();

            if (! $exists) {
                QuizToken::create([
                    'quiz_id' => $quiz->id,
                    'mahasiswa_id' => $student->id,
                    'token' => strtoupper(Str::random(8)),
                ]);
                $generated++;
            }
        }

        return redirect()->route('mahasiswa.index', array_filter([
            'quiz_id' => $quiz->id,
            'prodi_id' => $request->prodi_id,
        ]))->with('success', "Token berhasil digenerate untuk {$generated} mahasiswa.");
    }

    public function clearTokens(Request $request, Quiz $quiz)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);
        $quiz->tokens()->delete();

        return redirect()->route('mahasiswa.index', ['quiz_id' => $quiz->id])
            ->with('success', 'Semua token berhasil dihapus.');
    }
}
