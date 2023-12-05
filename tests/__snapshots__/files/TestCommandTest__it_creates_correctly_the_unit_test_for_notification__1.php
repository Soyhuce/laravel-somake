<?php

/* @covers \Domain\User\Notifications\AccountCreatedNotification */

use Domain\User\Notifications\AccountCreatedNotification;
use Illuminate\Notifications\Messages\MailMessage;

it('formats the mail', function (): void {
    $notification = new AccountCreatedNotification();

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