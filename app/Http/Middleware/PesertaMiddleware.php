<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PesertaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * 
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->roles === 'peserta') {
            return $next($request);
        }

        // Simpan URL saat ini ke session agar bisa digunakan setelah login
        session(['url.intended' => url()->current()]);

        return redirect()->route('masuk')->with('error', 'Anda tidak memiliki akses sebagai peserta.');
    }

}
