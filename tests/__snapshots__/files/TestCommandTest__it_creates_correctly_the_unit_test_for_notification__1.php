<?php

/* @covers \Domain\User\Notifications\AccountCreatedNotification */

use Domain\User\Notifications\AccountCreatedNotification;
use Illuminate\Notifications\Messages\MailMessage;

it('uses the mail channel', function (): void {
    $notification = new AccountCreatedNotification();

    expect($notification->via())->toContain('mail');
});

it('formats the mail', function (): void {
    $mail = (new AccountCreatedNotification())->toMail();

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