/* @@covers \{{ $covered }} */

use {{ $classFqcn }};
use Illuminate\Notifications\Messages\MailMessage;

it('formats the mail', function (): void {
    $notification = new {{ $classBasename }}();

    expect($notification->via())->toBe(['mail']);

    $mail = $notification->toMail();

    expect($mail)
        ->toBeInstanceOf(MailMessage::class)
        ->subject->toBe('')
        ->greeting->toBe('')
        ->introLines->toBe([''])
        ->actionText->toBe('')
        ->actionUrl->toBeUrl()->toBe('')
        ->outroLines->toBe([''])
        ->salutation->toBe('');
});