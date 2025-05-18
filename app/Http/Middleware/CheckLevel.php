<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $level
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $level): Response
    {
        $user = Auth::user();
        
        if (!$user || !$user->level || $user->level->kode_level !== $level) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}