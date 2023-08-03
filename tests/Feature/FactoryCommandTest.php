<?php declare(strict_types=1);

it('creates the factory correctly', function (): void {
    $this->artisan('somake:factory')
        ->expectsQuestion('What is the Model ?', 'User')
        ->expectsOutputToContain('The Database\\Factories\\User\\UserFactory class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('database/factories/User/UserFactory.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
