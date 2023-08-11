namespace {{ $namespace }};

@if($eventFqcn)
use {{ $eventFqcn }};
@endif
@if($queued)
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
@endif

class {{ $listener }}@if($queued) implements ShouldQueue @endif

{
@if($queued)
    use InteractsWithQueue;

@endif
    public function handle({{ $event }} $event): void
    {
    }
}
