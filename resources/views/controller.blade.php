namespace {{ $namespace }};
@if($baseClass)

use {{ $baseClass }};
@endif

class {{ $controller }}@if($baseClassName) extends {{$baseClassName}}@endif

{
}
