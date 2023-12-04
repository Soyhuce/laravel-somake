/* @@covers \{{ $covered }} */

use {{ $classFqcn }};

it('formats the mail', function (): void {
    $notification = new {{ $classBasename }}();

    $this->assertEquals(['mail'], $notification->via());

    $mail = $notification->toMail();

    $this->assertEquals('', $mail->subject);
    $this->assertEquals('', $mail->greeting);
    $this->assertEquals([''], $mail->introLines);
    $this->assertEquals('', $mail->actionText);
    $this->assertEquals('', $mail->actionUrl);
    $this->assertEquals([''], $mail->outroLines);
    $this->assertEquals('', $mail->salutation);
});