<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\Mahasiswa;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizPlayController extends Controller
{
    public function join(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $quiz = Quiz::where('code', strtoupper($request->code))->first();

        if (! $quiz) {
            return back()->withErrors(['code' => 'Kode kuis tidak ditemukan.']);
        }

        if (! $quiz->is_active) {
            return back()->withErrors(['code' => 'Kuis ini belum diaktifkan oleh dosen.']);
        }

        $activeSession = $quiz->activeSession();
        if (! $activeSession) {
            return back()->withErrors(['code' => 'Belum ada sesi aktif untuk kuis ini.']);
        }

        if ($quiz->questions()->count() === 0) {
            return back()->withErrors(['code' => 'Kuis ini belum memiliki soal.']);
        }

        $mahasiswa = $this->mahasiswa();
        $existing = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('quiz_session_id', $activeSession->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        if ($existing && $existing->completed_at) {
            return back()->withErrors(['code' => 'Anda sudah mengerjakan kuis ini di sesi ini.']);
        }

        session(['quiz_session_id' => $activeSession->id]);

        return redirect()->route('quiz.play', $quiz);
    }

    public function play(Request $request, Quiz $quiz)
    {
        abort_unless($quiz->is_active, 404);

        $mahasiswa = $this->mahasiswa();
        $sessionId = session('quiz_session_id');

        if (! $sessionId) {
            $activeSession = $quiz->activeSession();
            if (! $activeSession) {
                return redirect()->route('mahasiswa.dashboard')->with('error', 'Tidak ada sesi aktif untuk kuis ini.');
            }
            $sessionId = $activeSession->id;
            session(['quiz_session_id' => $sessionId]);
        }

        $attempt = QuizAttempt::firstOrCreate(
            ['quiz_id' => $quiz->id, 'quiz_session_id' => $sessionId, 'mahasiswa_id' => $mahasiswa->id],
            [
                'total_questions' => $quiz->questions()->count(),
                'question_order' => $quiz->questions()->pluck('id')->shuffle()->values()->toArray(),
                'started_at' => now(),
            ]
        );

        if ($attempt->completed_at) {
            return redirect()->route('quiz.result', $attempt);
        }

        $answeredIds = $attempt->answers()->pluck('question_id')->toArray();
        $questionOrder = $attempt->question_order ?? $quiz->questions()->orderBy('order')->pluck('id')->toArray();
        $nextQuestionId = collect($questionOrder)->first(fn ($id) => ! in_array($id, $answeredIds));

        $question = $nextQuestionId
            ? \App\Models\Question::with('options')->find($nextQuestionId)
            : null;

        if (! $question) {
            return $this->completeAttempt($attempt);
        }

        $currentNumber = count($answeredIds) + 1;
        $totalQuestions = $attempt->total_questions;

        return view('mahasiswa.play', compact('quiz', 'attempt', 'question', 'currentNumber', 'totalQuestions'));
    }

    public function answer(Request $request, Quiz $quiz, QuizAttempt $attempt)
    {
        $mahasiswa = $this->mahasiswa();
        abort_unless($attempt->mahasiswa_id === $mahasiswa->id, 403);
        abort_if($attempt->completed_at, 400);

        $validated = $request->validate([
            'question_id' => ['required', 'exists:questions,id'],
            'option_id' => ['nullable', 'exists:options,id'],
            'time_spent' => ['required', 'integer', 'min:0'],
        ]);

        $alreadyAnswered = $attempt->answers()
            ->where('question_id', $validated['question_id'])
            ->exists();

        if ($alreadyAnswered) {
            return response()->json(['status' => 'already_answered']);
        }

        $isCorrect = false;
        if ($validated['option_id']) {
            $isCorrect = \App\Models\Option::where('id', $validated['option_id'])
                ->where('question_id', $validated['question_id'])
                ->where('is_correct', true)
                ->exists();
        }

        AttemptAnswer::create([
            'quiz_attempt_id' => $attempt->id,
            'question_id' => $validated['question_id'],
            'option_id' => $validated['option_id'],
            'is_correct' => $isCorrect,
            'time_spent' => min($validated['time_spent'], 300),
        ]);

        $answeredCount = $attempt->answers()->count();

        if ($answeredCount >= $attempt->total_questions) {
            $this->completeAttempt($attempt);
            return response()->json(['status' => 'completed', 'redirect' => route('quiz.result', $attempt)]);
        }

        return response()->json(['status' => 'next', 'redirect' => route('quiz.play', $quiz)]);
    }

    public function result(Request $request, QuizAttempt $attempt)
    {
        $mahasiswaId = session('mahasiswa_id');
        $dosenId = auth()->id();

        abort_unless(
            ($mahasiswaId && $attempt->mahasiswa_id === $mahasiswaId) ||
            ($dosenId && $attempt->quiz->user_id === $dosenId),
            403
        );

        $attempt->load(['quiz', 'session', 'answers.question', 'answers.option']);

        return view('mahasiswa.result', compact('attempt'));
    }

    public function dashboard()
    {
        $mahasiswa = $this->mahasiswa();
        $attempts = $mahasiswa->quizAttempts()->with(['quiz', 'session'])->latest()->get();

        return view('mahasiswa.dashboard', compact('attempts', 'mahasiswa'));
    }

    private function mahasiswa(): Mahasiswa
    {
        return Mahasiswa::findOrFail(session('mahasiswa_id'));
    }

    private function completeAttempt(QuizAttempt $attempt)
    {
        $score = $attempt->answers()->where('is_correct', true)->count();
        $attempt->update([
            'score' => $score,
            'completed_at' => now(),
        ]);

        return redirect()->route('quiz.result', $attempt);
    }
}
