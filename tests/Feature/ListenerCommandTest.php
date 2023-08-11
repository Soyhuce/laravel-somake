<?php declare(strict_types=1);

it('creates the listener correctly', function (): void {
    $this->artisan('somake:listener')
        ->expectsQuestion('What is the Listener name ?', 'SendWelcomeEmail')
        ->expectsQuestion('Which event should the listener listen to ?', 'Domain\User\Events\UserRegistered')
        ->expectsQuestion('Should the listener be queued ?', true)
        ->expectsQuestion('What is the Domain ?', 'User')
        ->expectsOutputToContain('The Domain\\User\\Listeners\\SendWelcomeEmail class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\User\Listeners\SendWelcomeEmail ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Listeners/SendWelcomeEmail.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates the listener not queued and without event defined', function (): void {
    $this->artisan('somake:listener')
        ->expectsQuestion('What is the Listener name ?', 'SendWelcomeEmail')
        ->expectsQuestion('Which event should the listener listen to ?', '')
        ->expectsQuestion('Should the listener be queued ?', false)
        ->expectsQuestion('What is the Domain ?', 'User')
        ->expectsOutputToContain('The Domain\\User\\Listeners\\SendWelcomeEmail class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\User\Listeners\SendWelcomeEmail ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Listeners/SendWelcomeEmail.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
