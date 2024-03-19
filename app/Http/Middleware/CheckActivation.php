<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActivation
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->activation) {
            abort(403, 'Account not activated.');
        }

        return $next($request);
    }
}

