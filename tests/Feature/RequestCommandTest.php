<?php declare(strict_types=1);

it('creates the request correctly', function (): void {
    $this->artisan('somake:request')
        ->expectsQuestion('What is the Request name ?', 'LoginRequest')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Website/Auth')
        ->expectsQuestion(
            'You may want LoginRequest to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsQuestion('Do you want to fill the request with fields from a DTO ?', false)
        ->expectsOutput('The App\\Website\\Auth\\Requests\\LoginRequest class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Website\\Auth\\Requests\\LoginRequest ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Auth/Requests/LoginRequest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('prefills the request with dto fields', function (): void {
    $this->artisan('somake:request')
        ->expectsQuestion('What is the Request name ?', 'UserRequest')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion(
            'You may want UserRequest to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsQuestion('Do you want to fill the request with fields from a DTO ?', true)
        ->expectsQuestion('What is the DTO ?', 'UserDTO')
        ->expectsOutput('The App\\Admin\\Requests\\UserRequest class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Requests\\UserRequest ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Admin/Requests/UserRequest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates the request with custom base class', function (): void {
    config()->set('somake.base_classes.request', 'Support\\Http\\Request');

    $this->artisan('somake:request')
        ->expectsQuestion('What is the Request name ?', 'LoginRequest')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Website/Auth')
        ->expectsQuestion(
            'You may want LoginRequest to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsQuestion('Do you want to fill the request with fields from a DTO ?', false)
        ->expectsOutput('The App\\Website\\Auth\\Requests\\LoginRequest class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Website\\Auth\\Requests\\LoginRequest ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Auth/Requests/LoginRequest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
