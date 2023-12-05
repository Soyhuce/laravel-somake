namespace {{ $namespace }};

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
@if($queued)
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
@endif

class {{ $notification }} extends Notification @if($queued)implements ShouldQueue @endif

{
@if($queued)
    use Queueable;

@endif
    public function __construct()
    {
    }

    /**
    * @return array<string>|string
    */
    public function via(): array|string
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject(trans('Welcome to our platform'));
    }
}
