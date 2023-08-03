<?php declare(strict_types=1);

it('creates the action', function (): void {
    $this->artisan('somake:action')
        ->expectsQuestion('What is the Action name ?', 'CreatePost')
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutputToContain('The Domain\\Blog\\Actions\\CreatePost class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\\Blog\\Actions\\CreatePost ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Actions/CreatePost.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates the action with custom base class', function (): void {
    config()->set('somake.base_classes.action', 'Support\Action');

    $this->artisan('somake:action')
        ->expectsQuestion('What is the Action name ?', 'CreatePost')
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutputToContain('The Domain\\Blog\\Actions\\CreatePost class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Domain\\Blog\\Actions\\CreatePost ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Actions/CreatePost.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
