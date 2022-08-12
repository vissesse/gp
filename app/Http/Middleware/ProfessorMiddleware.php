<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfessorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!($request->user()->categoria == 'Admin' or $request->user()->categoria == 'Estudante') && Auth::check())
            return redirect()->back();
        return $next($request);
    }
}
