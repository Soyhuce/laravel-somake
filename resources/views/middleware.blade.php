namespace {{ $namespace }};

use Closure;
use Illuminate\Http\Request;

class {{ $middleware }}
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
