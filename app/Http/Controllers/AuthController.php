<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
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
            $quiz = Quiz::where('code', $kodeKuis)->first();
            if (! $quiz) {
                return back()->withErrors(['kode_kuis' => 'Kode kuis tidak ditemukan.'])->onlyInput('nim', 'kode_kuis');
            }

            if (! $quiz->is_active) {
                return back()->withErrors(['kode_kuis' => 'Kuis ini belum diaktifkan oleh dosen.'])->onlyInput('nim', 'kode_kuis');
            }

            $user = User::where('nim', $request->nim)->first();
            if (! $user) {
                return back()->withErrors(['nim' => 'NIM tidak ditemukan.'])->onlyInput('nim', 'kode_kuis');
            }

            $token = QuizToken::where('quiz_id', $quiz->id)
                ->where('user_id', $user->id)
                ->whereNull('used_at')
                ->first();

            if (! $token || strtoupper($request->password) !== strtoupper($token->token)) {
                return back()->withErrors(['password' => 'Token kuis salah atau sudah digunakan.'])->onlyInput('nim', 'kode_kuis');
            }

            Auth::login($user);
            $request->session()->regenerate();
            $token->update(['used_at' => now()]);

            return redirect()->route('quiz.play', $quiz);
        }

        if (Auth::attempt(['nim' => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['nim' => 'NIM atau password salah.'])->onlyInput('nim');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'nim' => ['nullable', 'string', 'max:20', 'unique:users'],
            'role' => ['required', 'in:dosen,mahasiswa'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
