<?php declare(strict_types=1);

it('creates the command correctly', function (): void {
    $this->artisan('somake:command')
        ->expectsQuestion('What is the Command name ?', 'ConvertModels')
        ->expectsOutputToContain('The App\\Commands\\ConvertModels class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Commands\\ConvertModels ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Commands/ConvertModels.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
