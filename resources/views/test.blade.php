/* @@covers \{{ $covers }} */

@foreach($uses as $use)
use {!! $use !!};
@endforeach

@foreach($tests as $test)
{!! $test !!}
@endforeach
