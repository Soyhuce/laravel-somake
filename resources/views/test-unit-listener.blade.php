/* @@covers \{{ $covered }} */

use {{ $classFqcn }};
@if($eventFqcn)
use {{ $eventFqcn }};
@endif
use Illuminate\Support\Facades\Event;

it('listens {{ $event }} event', function (): void {
    Event::fake();
    Event::assertListening(
        {{ $event }}::class,
        {{ $classBasename }}::class
    );
});

it('handle the {{ $event }} event', function (): void {
    $event = new {{ $event }}();
    $listener = new {{ $classBasename }}();

    $listener->handle($event);
});
