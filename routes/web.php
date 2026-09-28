<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizPlayController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dosen Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Dosen
Route::middleware('auth')->group(function () {
    // Quiz CRUD
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');

    // Quiz Tokens (on mahasiswa page)
    Route::post('/mahasiswa/tokens/{quiz}/generate', [MahasiswaController::class, 'generateTokens'])->name('mahasiswa.tokens.generate');
    Route::delete('/mahasiswa/tokens/{quiz}/clear', [MahasiswaController::class, 'clearTokens'])->name('mahasiswa.tokens.clear');

    // Quiz Sessions
    Route::post('/quizzes/{quiz}/sessions', [QuizController::class, 'startSession'])->name('quizzes.sessions.start');
    Route::post('/quizzes/{quiz}/sessions/{session}/end', [QuizController::class, 'endSession'])->name('quizzes.sessions.end');
    Route::get('/quizzes/{quiz}/sessions/{session}/results', [QuizController::class, 'sessionResults'])->name('quizzes.sessions.results');

    // Questions
    Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    // Master Data
    Route::get('/master-data', [MasterDataController::class, 'index'])->name('master-data.index');
    Route::post('/master-data/{type}', [MasterDataController::class, 'store'])->name('master-data.store');
    Route::delete('/master-data/{type}/{id}', [MasterDataController::class, 'destroy'])->name('master-data.destroy');

    // Mahasiswa List
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
});

// Mahasiswa
Route::middleware('mahasiswa')->group(function () {
    Route::get('/mahasiswa/dashboard', [QuizPlayController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::post('/quiz/join', [QuizPlayController::class, 'join'])->name('quiz.join');
    Route::get('/quiz/{quiz}/play', [QuizPlayController::class, 'play'])->name('quiz.play');
    Route::post('/quiz/{quiz}/attempt/{attempt}/answer', [QuizPlayController::class, 'answer'])->name('quiz.answer');
});

// Result - accessible by both dosen and mahasiswa
Route::get('/quiz/result/{attempt}', [QuizPlayController::class, 'result'])->name('quiz.result');
