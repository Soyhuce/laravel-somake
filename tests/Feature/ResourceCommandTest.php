<?php declare(strict_types=1);

it('creates the resource correctly', function (): void {
    $this->artisan('somake:resource')
        ->expectsQuestion('What is the Resource name ?', 'UserResource')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion('What is the Model ?', 'User')
        ->expectsOutput('The App\\Admin\\Resources\\User\\UserResource class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Resources\\User\\UserResource ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Admin/Resources/User/UserResource.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates the resource using soyhuce/laravel-json-resources', function (): void {
    config()->set('somake.base_classes.resource', 'Soyhuce\\JsonResources\\JsonResource');

    $this->artisan('somake:resource')
        ->expectsQuestion('What is the Resource name ?', 'UserResource')
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion('What is the Model ?', 'User')
        ->expectsOutput('The App\\Admin\\Resources\\User\\UserResource class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Resources\\User\\UserResource ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Admin/Resources/User/UserResource.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
