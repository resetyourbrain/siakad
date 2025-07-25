<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SessionExpired
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $timeout = config('session.lifetime') * 60; // dalam detik
        $lastActivity = Session::get('lastActivityTime');

        if ($lastActivity && (time() - $lastActivity > $timeout)) {
            Auth::logout();
            Session::flush();
            return redirect('/login')->withErrors(['message' => 'Sesi Anda telah berakhir. Silakan login kembali.']);
        }

        Session::put('lastActivityTime', time());

        return $next($request);
    }
}
