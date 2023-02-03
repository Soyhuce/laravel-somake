/* @@covers \{{ $covered }} */

use {{ $classFqcn }};

it('passes validation', function (): void {
    $this->createRequest({{ $classBasename }}::class)
        ->validate([
@foreach($parameters as $parameter)
            '{{ $parameter }}' => '',
@endforeach
        ])
        ->assertPasses();
});
