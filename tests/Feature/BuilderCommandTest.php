<?php declare(strict_types=1);

it('creates the builder correctly', function (): void {
    $this->artisan('somake:builder')
        ->expectsQuestion('What is the Model ?', 'User')
        ->expectsOutput('The Domain\\User\\Builders\\UserBuilder class was successfully created !')
        ->expectsQuestion('Do you want to add implementation of newEloquentBuilder in Domain\\User\\Models\\User ?', true)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/User/Builders/UserBuilder.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();

    expect($this->app->basePath('app/Domain/User/Models/User.php'))
        ->toMatchFileSnapshot();
});
