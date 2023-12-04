<?php

namespace Domain\User\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification 
{
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
            ->subject('Welcome to our platform');
    }
}
