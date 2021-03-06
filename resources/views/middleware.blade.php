namespace {{ $namespace }};

use Closure;
use Illuminate\Http\Request;

class {{ $className }}
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
