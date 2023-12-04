namespace {{ $namespace }};

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
@if($multilingual)
use Illuminate\Support\Facades\Lang;
@endif
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
            ->subject(@if($multilingual)Lang::get('Welcome to our platform')@else'Welcome to our platform'@endif);
    }
}
