<?php declare(strict_types=1);

it('creates an enum correctly', function (): void {
    $this->artisan('somake:enum')
        ->expectsQuestion('What is the Enum name ?', 'Status')
        ->expectsQuestion('Where do you want it to be created ?', 'Domain')
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutputToContain('The Domain\\Blog\\Enums\\Status enum was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Enums/Status.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates an enum in support', function (): void {
    $this->artisan('somake:enum')
        ->expectsQuestion('What is the Enum name ?', 'Status')
        ->expectsQuestion('Where do you want it to be created ?', 'Support')
        ->expectsOutputToContain('The Support\\Enums\\Status enum was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Support/Enums/Status.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
