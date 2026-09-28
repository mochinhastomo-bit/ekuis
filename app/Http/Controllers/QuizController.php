<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Periode;
use App\Models\Prodi;
use App\Models\Quiz;
use App\Models\QuizToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function create()
    {
        return view('dosen.quizzes.create', $this->masterData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'periode_id' => ['nullable', 'exists:periodes,id'],
            'prodi_id' => ['nullable', 'exists:prodis,id'],
            'matakuliah_id' => ['nullable', 'exists:matakuliahs,id'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
        ]);

        $quiz = $request->user()->quizzes()->create($validated);

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Kuis berhasil dibuat! Tambahkan soal.');
    }

    public function show(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);
        $quiz->load(['questions.options', 'attempts.user', 'periode', 'prodi', 'matakuliah', 'kelas', 'tokens.user']);

        return view('dosen.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);

        return view('dosen.quizzes.edit', array_merge(compact('quiz'), $this->masterData()));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'periode_id' => ['nullable', 'exists:periodes,id'],
            'prodi_id' => ['nullable', 'exists:prodis,id'],
            'matakuliah_id' => ['nullable', 'exists:matakuliahs,id'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $quiz->update($validated);

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);
        $quiz->delete();

        return redirect()->route('dashboard')->with('success', 'Kuis berhasil dihapus.');
    }

    public function generateTokens(Request $request, Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);

        $request->validate([
            'prodi' => ['nullable', 'string'],
        ]);

        $query = User::where('role', 'mahasiswa');
        if ($request->prodi) {
            $query->where('prodi', $request->prodi);
        }
        $students = $query->get();

        if ($students->isEmpty()) {
            return back()->withErrors(['prodi' => 'Tidak ada mahasiswa ditemukan.']);
        }

        $generated = 0;
        foreach ($students as $student) {
            $exists = QuizToken::where('quiz_id', $quiz->id)
                ->where('user_id', $student->id)
                ->exists();

            if (! $exists) {
                QuizToken::create([
                    'quiz_id' => $quiz->id,
                    'user_id' => $student->id,
                    'token' => strtoupper(Str::random(8)),
                ]);
                $generated++;
            }
        }

        return back()->with('success', "Token berhasil digenerate untuk {$generated} mahasiswa.");
    }

    public function clearTokens(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);
        $quiz->tokens()->delete();

        return back()->with('success', 'Semua token berhasil dihapus.');
    }

    private function authorizeQuiz(Quiz $quiz): void
    {
        abort_unless($quiz->user_id === auth()->id(), 403);
    }

    private function masterData(): array
    {
        return [
            'periodes' => Periode::orderBy('nama')->get(),
            'prodis' => Prodi::orderBy('nama')->get(),
            'matakuliahs' => Matakuliah::orderBy('nama')->get(),
            'kelasList' => Kelas::orderBy('nama')->get(),
        ];
    }
}
