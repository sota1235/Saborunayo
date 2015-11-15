<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  AuthManager               $authManager
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = \Auth::driver('github');

        if ($auth->guest()) {
            return $next($request);
        }

        return redirect()->route('main');
    }
}
