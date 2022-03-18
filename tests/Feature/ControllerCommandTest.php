<?php declare(strict_types=1);

it('creates the controller correctly', function (): void {
    $this->artisan('somake:controller')
        ->expectsQuestion('What is the Controller name ?', 'PostController')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Website/Blog')
        ->expectsQuestion(
            'You may want PostController to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsOutput('The App\\Website\\Blog\\Controllers\\PostController class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Blog/Controllers/PostController.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('allows the controller to live in a sub namespace', function (): void {
    $this->artisan('somake:controller')
        ->expectsQuestion('What is the Controller name ?', 'LoginController')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion(
            'You may want LoginController to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            'Auth'
        )
        ->expectsOutput('The App\\Admin\\Controllers\\Auth\\LoginController class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Admin/Controllers/Auth/LoginController.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('allows the controller to extend custom base class', function (): void {
    config()->set(['somake.base_classes.controller' => 'Support\Http\Controller']);

    $this->artisan('somake:controller')
        ->expectsQuestion('What is the Controller name ?', 'PostController')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Website/Blog')
        ->expectsQuestion(
            'You may want PostController to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsOutput('The App\\Website\\Blog\\Controllers\\PostController class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Blog/Controllers/PostController.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
