<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $mahasiswaId = session('mahasiswa_id');

        if (! $mahasiswaId || ! Mahasiswa::find($mahasiswaId)) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
