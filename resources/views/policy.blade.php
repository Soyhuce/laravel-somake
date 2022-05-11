namespace {{ $namespace }};

@if($baseClass)
use {{ $baseClass }};
@else
use Illuminate\Auth\Access\HandlesAuthorization;
@endif

class {{ $className }}@if($baseClassName) extends {{$baseClassName}}@endif

{
@if(!$baseClassName)
    use HandlesAuthorization;
@endif
}
