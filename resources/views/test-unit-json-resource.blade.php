/* @@covers \{{ $covered }} */

use {{ $classFqcn }};
@if($modelFqcn !== null)
use {{ $modelFqcn }};
@endif

it('formats the {{ $model }}', function (): void {
@if($modelClassBasename !== null)
    ${{ $model}} = {{ $modelClassBasename }}::factory()->createOne();
@endif

    $this->createResponse({{ $classBasename }}::make(${{ $model }}))->assertData([
@foreach($fields as $field)
        '{{ $field }}' => '',
@endforeach
    ]);
});
