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

        // Simpan URL intended hanya jika belum login
        if (!auth()->check()) {
            session(['url.intended' => url()->full()]);
        }

        // Izinkan akses halaman, tapi pakai flag untuk munculkan modal login
        $request->merge(['show_login_modal' => true]);

        return $next($request);
    }


}
