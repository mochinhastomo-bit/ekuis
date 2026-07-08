<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);

        return view('dosen.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'time_limit' => ['required', 'integer', 'min:5', 'max:300'],
            'options' => ['required', 'array', 'min:2', 'max:6'],
            'options.*.text' => ['required', 'string', 'max:500'],
            'correct_option' => ['required', 'integer', 'min:0'],
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $validated['question_text'],
            'time_limit' => $validated['time_limit'],
            'order' => $quiz->questions()->count(),
        ]);

        foreach ($validated['options'] as $index => $opt) {
            $question->options()->create([
                'option_text' => $opt['text'],
                'is_correct' => $index === (int) $validated['correct_option'],
            ]);
        }

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz, Question $question)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);
        $question->load('options');

        return view('dosen.questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'time_limit' => ['required', 'integer', 'min:5', 'max:300'],
            'options' => ['required', 'array', 'min:2', 'max:6'],
            'options.*.text' => ['required', 'string', 'max:500'],
            'correct_option' => ['required', 'integer', 'min:0'],
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'time_limit' => $validated['time_limit'],
        ]);

        $question->options()->delete();

        foreach ($validated['options'] as $index => $opt) {
            $question->options()->create([
                'option_text' => $opt['text'],
                'is_correct' => $index === (int) $validated['correct_option'],
            ]);
        }

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        abort_unless($quiz->user_id === auth()->id(), 403);
        $question->delete();

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Soal berhasil dihapus.');
    }
}
