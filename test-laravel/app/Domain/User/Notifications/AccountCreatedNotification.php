<?php declare(strict_types=1);

namespace Domain\User\Notifications;

use Domain\User\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification
{
    /**
     * @return array<string>|string
     */
    public function via(): array|string
    {
        return ['mail'];
    }

    public function toMail(User $user): MailMessage
    {
        return (new MailMessage())
            ->greeting(trans('Hello :name,', ['name' => $user->name]))
            ->subject(trans('Your account has been created'))
            ->line(trans('Your account has been created, you can now connect to the platform using your usual credentials.'))
            ->action(trans('Connect'), url('/'));
    }
}
