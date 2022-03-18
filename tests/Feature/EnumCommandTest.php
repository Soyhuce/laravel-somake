<?php declare(strict_types=1);

it('creates an enum correctly', function (): void {
    $this->artisan('somake:enum')
        ->expectsQuestion('What is the Enum name ?', 'Status')
        ->expectsQuestion('Do you want it to be in a Domain ? Say no if you want it in Support', true)
        ->expectsOutput('I detected 1 domain.')
        ->expectsTable(['Domain'], [['User']])
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutput('The Domain\\Blog\\Enums\\Status enum was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Enums/Status.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates an enum in support', function (): void {
    $this->artisan('somake:enum')
        ->expectsQuestion('What is the Enum name ?', 'Status')
        ->expectsQuestion('Do you want it to be in a Domain ? Say no if you want it in Support', false)
        ->expectsOutput('The Support\\Enums\\Status enum was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Support/Enums/Status.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
