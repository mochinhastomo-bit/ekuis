<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Periode;
use App\Models\Prodi;
use App\Models\Quiz;
use App\Models\QuizSession;
use Illuminate\Http\Request;

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
        ]);

        $quiz = $request->user()->quizzes()->create($validated);

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Kuis berhasil dibuat! Tambahkan soal.');
    }

    public function show(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);
        $quiz->load(['questions.options', 'periode', 'prodi', 'matakuliah', 'sessions' => fn ($q) => $q->withCount('attempts')->latest()]);

        $activeSession = $quiz->sessions->firstWhere('is_active', true);

        return view('dosen.quizzes.show', compact('quiz', 'activeSession'));
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

    public function startSession(Request $request, Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $quiz->sessions()->where('is_active', true)->update([
            'is_active' => false,
            'ended_at' => now(),
        ]);

        QuizSession::create([
            'quiz_id' => $quiz->id,
            'name' => $request->name,
            'is_active' => true,
            'started_at' => now(),
        ]);

        return back()->with('success', "Sesi \"{$request->name}\" berhasil dimulai.");
    }

    public function endSession(Quiz $quiz, QuizSession $session)
    {
        $this->authorizeQuiz($quiz);
        abort_unless($session->quiz_id === $quiz->id, 404);

        $session->update([
            'is_active' => false,
            'ended_at' => now(),
        ]);

        return back()->with('success', "Sesi \"{$session->name}\" berhasil diakhiri.");
    }

    public function sessionResults(Quiz $quiz, QuizSession $session)
    {
        $this->authorizeQuiz($quiz);
        abort_unless($session->quiz_id === $quiz->id, 404);

        $session->load(['attempts.mahasiswa']);
        $quiz->load(['periode', 'prodi', 'matakuliah']);

        return view('dosen.quizzes.session-results', compact('quiz', 'session'));
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
        ];
    }
}
