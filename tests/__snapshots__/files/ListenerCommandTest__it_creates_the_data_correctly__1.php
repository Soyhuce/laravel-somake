<?php

namespace Domain\User\Listeners;

use Domain\User\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail implements ShouldQueue 
{
    use InteractsWithQueue;

    public function handle(UserRegistered $event): void
    {
    }
}
