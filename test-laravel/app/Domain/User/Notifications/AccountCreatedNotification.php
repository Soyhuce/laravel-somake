<?php declare(strict_types=1);

namespace Domain\User\Notifications;

use Domain\User\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

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
            ->greeting(Lang::get('Hello :name,', ['name' => $user->name]))
            ->subject(Lang::get('Your account has been created'))
            ->line(Lang::get('Your account has been created, you can now connect to the platform using your usual credentials.'))
            ->action(Lang::get('Connect'), url('/'));
    }
}
