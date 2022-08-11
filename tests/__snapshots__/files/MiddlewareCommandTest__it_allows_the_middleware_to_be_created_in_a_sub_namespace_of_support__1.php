<?php

namespace Support\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class OnlySuperAdmin
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
