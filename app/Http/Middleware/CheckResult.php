<?php

namespace App\Http\Middleware;

use App\Helper\Helper;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckResult
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = Auth::user();

        if (Helper::hasResult($auth?->token)) {
            return response()->view('errors.expired');
        }

        return $next($request);
    }
}
