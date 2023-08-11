<?php declare(strict_types=1);

it('creates the event correctly', function (): void {
    $this->artisan('somake:event')
        ->expectsQuestion('What is the Event name ?', 'PostCreated')
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutputToContain('The Domain\\Blog\\Events\\PostCreated class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Events/PostCreated.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
