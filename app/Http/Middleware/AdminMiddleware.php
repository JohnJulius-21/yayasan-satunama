<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->roles === 'admin') {
            return $next($request);
        }

        // Simpan URL saat ini ke session agar bisa digunakan setelah login
        session(['url.intended' => url()->current()]);
        
        return redirect()->route('adminLogin')->with('error', 'Anda tidak memiliki akses sebagai admin.');
    }
}
