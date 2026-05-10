<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pengecekkan hak ases user
        // Jika role user adalah bukan admin 
        if (!Auth::check() || Auth::user()->role != 'admin' || Auth::user()->role == null) {

            // Maka alihkan ke halaman NOT FOUND 404
            return redirect('/404');
        }

        // Dan jika role user adalah admin, maka alihkan ke halaman yang dituju
        return $next($request);
    }
}
