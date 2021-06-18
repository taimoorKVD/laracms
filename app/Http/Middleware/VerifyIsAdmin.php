<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsAdmin
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
        if(!auth()->user()->isAdmin())
        {
            return redirect()
                ->back()
                ->with('error-message', 'You are not allowed to go to user management.');
        }
        return $next($request);
    }
}
