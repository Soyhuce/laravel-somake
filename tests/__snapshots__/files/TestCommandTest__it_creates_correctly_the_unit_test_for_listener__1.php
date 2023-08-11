<?php

/* @covers \Domain\User\Listeners\IncrementUserStatistics */

use Domain\User\Listeners\IncrementUserStatistics;
use Domain\User\Events\UserRegistered;
use Illuminate\Support\Facades\Event;

it('listens UserRegistered event', function (): void {
    Event::fake();
    Event::assertListening(
        UserRegistered::class,
        IncrementUserStatistics::class
    );
});

it('handle the UserRegistered event', function (): void {
    $event = new UserRegistered();
    $listener = new IncrementUserStatistics();

    $listener->handle($event);
});
