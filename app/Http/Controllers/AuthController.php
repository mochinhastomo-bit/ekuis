<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Quiz;
use App\Models\QuizToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        if (session('mahasiswa_id')) {
            return redirect()->route('mahasiswa.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => ['required', 'string'],
            'password' => ['required'],
            'kode_kuis' => ['nullable', 'string', 'size:6'],
        ]);

        $kodeKuis = $request->kode_kuis ? strtoupper(trim($request->kode_kuis)) : null;

        if ($kodeKuis) {
            return $this->loginMahasiswa($request, $kodeKuis);
        }

        if (Auth::attempt(['nim' => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['nim' => 'NIM atau password salah.'])->onlyInput('nim');
    }

    private function loginMahasiswa(Request $request, string $kodeKuis)
    {
        $quiz = Quiz::where('code', $kodeKuis)->first();
        if (! $quiz) {
            return back()->withErrors(['kode_kuis' => 'Kode kuis tidak ditemukan.'])->onlyInput('nim', 'kode_kuis');
        }

        if (! $quiz->is_active) {
            return back()->withErrors(['kode_kuis' => 'Kuis ini belum diaktifkan oleh dosen.'])->onlyInput('nim', 'kode_kuis');
        }

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
        if (! $mahasiswa) {
            return back()->withErrors(['nim' => 'NIM tidak ditemukan.'])->onlyInput('nim', 'kode_kuis');
        }

        $token = QuizToken::where('quiz_id', $quiz->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereNull('used_at')
            ->first();

        if (! $token || strtoupper($request->password) !== strtoupper($token->token)) {
            return back()->withErrors(['password' => 'Token kuis salah atau sudah digunakan.'])->onlyInput('nim', 'kode_kuis');
        }

        $request->session()->regenerate();
        session(['mahasiswa_id' => $mahasiswa->id]);
        $token->update(['used_at' => now()]);

        return redirect()->route('quiz.play', $quiz);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('mahasiswa_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
