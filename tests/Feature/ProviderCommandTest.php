<?php declare(strict_types=1);

it('creates the service provider correctly', function (): void {
    $this->artisan('somake:provider')
        ->expectsQuestion('What is the ServiceProvider name ?', 'TestingServiceProvider')
        ->expectsOutputToContain('The Support\\Providers\\TestingServiceProvider class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Support/Providers/TestingServiceProvider.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
