<?php

namespace App\Http\Middleware;

use Closure;

class ValidateHeaders
{
    public function handle($request, Closure $next)
    {
        if ($request->path() !== '/') {
            if (!$request->header('user-id')) {
                return response()->json(['error' => 'userid header is missing'], 400);
            }
        }

        return $next($request);
    }
}
