<?php

namespace Support\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterUnpublished
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
