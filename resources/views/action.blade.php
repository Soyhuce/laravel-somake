namespace {{ $namespace }};
@if($baseClass)

use {{ $baseClass }};
@endif

class {{ $action }}@if($baseClassName) extends {{$baseClassName}}@endif

{
    public function execute(): void
    {
    }
}
