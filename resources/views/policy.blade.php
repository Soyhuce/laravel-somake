namespace {{ $namespace }};

use Illuminate\Auth\Access\HandlesAuthorization;
@if($baseClass)
use {{ $baseClass }};
@endif

class {{ $className }}@if($baseClassName) extends {{$baseClassName}}@endif

{
    use HandlesAuthorization;
}
