<?php declare(strict_types=1);

it('creates the policy correctly', function (): void {
    $this->artisan('somake:policy')
        ->expectsQuestion('What is the Model ?', 'User')
        ->expectsOutput('The Domain\\User\\Policies\\UserPolicy class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\\User\\Policies\\UserPolicy ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Policies/UserPolicy.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates the policy with custom base class', function (): void {
    config()->set('somake.base_classes.policy', 'Support\Policy');

    $this->artisan('somake:policy')
        ->expectsQuestion('What is the Model ?', 'User')
        ->expectsOutput('The Domain\\User\\Policies\\UserPolicy class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\\User\\Policies\\UserPolicy ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Policies/UserPolicy.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
