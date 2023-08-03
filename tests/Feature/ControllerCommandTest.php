<?php declare(strict_types=1);

it('creates the controller correctly', function (): void {
    $this->artisan('somake:controller')
        ->expectsQuestion('What is the Controller name ?', 'PostController')
        ->expectsQuestion('What is the Application ?', 'Website/Blog')
        ->expectsQuestion(
            'You may want PostController to live in a sub namespace. Which one ?',
            ''
        )
        ->expectsOutputToContain('The App\\Website\\Blog\\Controllers\\PostController class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Blog/Controllers/PostController.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('allows the controller to live in a sub namespace', function (): void {
    $this->artisan('somake:controller')
        ->expectsQuestion('What is the Controller name ?', 'LoginController')
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion(
            'You may want LoginController to live in a sub namespace. Which one ?',
            'Auth'
        )
        ->expectsOutputToContain('The App\\Admin\\Controllers\\Auth\\LoginController class was successfully created !')
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
        ->expectsQuestion('What is the Application ?', 'Website/Blog')
        ->expectsQuestion(
            'You may want PostController to live in a sub namespace. Which one ?',
            ''
        )
        ->expectsOutputToContain('The App\\Website\\Blog\\Controllers\\PostController class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Blog/Controllers/PostController.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
