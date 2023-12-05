/* @@covers \{{ $covered }} */

use {{ $classFqcn }};
use Illuminate\Notifications\Messages\MailMessage;

it('uses the mail channel', function (): void {
    $notification = new {{ $classBasename }}();

    expect($notification->via())->toContain('mail');
});

it('formats the mail', function (): void {
    $mail = (new {{ $classBasename }}())->toMail();

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