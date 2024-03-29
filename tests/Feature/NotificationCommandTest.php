<?php declare(strict_types=1);

it('creates the notification correctly', function (): void {
    $this->artisan('somake:notification')
        ->expectsQuestion('What is the Notification name ?', 'WelcomeNotification')
        ->expectsQuestion('Should the notification be queued ?', true)
        ->expectsQuestion('What is the Domain ?', 'User')
        ->expectsOutputToContain('The Domain\\User\\Notifications\\WelcomeNotification class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\User\Notifications\WelcomeNotification ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Notifications/WelcomeNotification.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates the notification not queued', function (): void {
    $this->artisan('somake:notification')
        ->expectsQuestion('What is the Notification name ?', 'WelcomeNotification')
        ->expectsQuestion('Should the notification be queued ?', false)
        ->expectsQuestion('What is the Domain ?', 'User')
        ->expectsOutputToContain('The Domain\\User\\Notifications\\WelcomeNotification class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\User\Notifications\WelcomeNotification ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Notifications/WelcomeNotification.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
