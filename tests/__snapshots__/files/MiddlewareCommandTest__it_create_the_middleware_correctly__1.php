<?php

namespace App\Website\Blog\Middlewares;

use Closure;
use Illuminate\Http\Request;

class FilterUnpublished
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
