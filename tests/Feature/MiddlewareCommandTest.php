<?php declare(strict_types=1);

it('create the middleware correctly', function (): void {
    $this->artisan('somake:middleware')
        ->expectsQuestion('What is the Middleware name ?', 'FilterUnpublished')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Website/Blog')
        ->expectsQuestion(
            'You may want FilterUnpublished to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsOutput('The App\\Website\\Blog\\Middlewares\\FilterUnpublished class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Website\\Blog\\Middlewares\\FilterUnpublished ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Blog/Middlewares/FilterUnpublished.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('allows the middleware to be created in a sub namespace', function (): void {
    $this->artisan('somake:middleware')
        ->expectsQuestion('What is the Middleware name ?', 'OnlySuperAdmin')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion(
            'You may want OnlySuperAdmin to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            'Auth'
        )
        ->expectsOutput('The App\\Admin\\Middlewares\\Auth\\OnlySuperAdmin class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Middlewares\\Auth\\OnlySuperAdmin ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Admin/Middlewares/Auth/OnlySuperAdmin.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
