<?php declare(strict_types=1);

it('creates correctly the contract test', function (): void {
    file_put_contents(base_path('tests/Pest.php'), '');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Contract')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', 'show')
        ->expectsQuestion('What is the Test name ?', 'ContractShowVideoTest')
        ->expectsOutputToContain('The Tests\\Contract\\Website\\Videos\\Video\\ContractShowVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Contract/Website/Videos/Video/ContractShowVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the feature test', function (): void {
    file_put_contents(base_path('tests/Pest.php'), '');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', 'show')
        ->expectsQuestion('What is the Test name ?', 'ShowVideoTest')
        ->expectsOutputToContain('The Tests\\Feature\\Website\\Videos\\VideoController\\ShowVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the feature test with unknown method', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', 'index')
        ->expectsQuestion('What is the Test name ?', 'IndexVideosTest')
        ->expectsOutputToContain('The Tests\\Feature\\Website\\Videos\\VideoController\\IndexVideosTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Feature/Website/Videos/VideoController/IndexVideosTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the feature test with invokable controller', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
        ->expectsQuestion('Which controller do you want to cover ?', 'InvokableVideoController')
        ->expectsQuestion('Which method do you want to cover ?', '__invoke')
        ->expectsQuestion('What is the Test name ?', 'IndexVideosTest')
        ->expectsOutputToContain('The Tests\\Feature\\Website\\Videos\\InvokableVideoController\\IndexVideosTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Feature/Website/Videos/InvokableVideoController/IndexVideosTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit test', function (): void {
    file_put_contents(base_path('tests/Pest.php'), '');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'User')
        ->expectsOutputToContain('The Tests\\Unit\\Domain\\User\\Models\\UserTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit test for form request', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'UpdateVideoRequest')
        ->expectsOutputToContain('The Tests\\Unit\\App\\Website\\Videos\\Requests\\UpdateVideoRequestTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/App/Website/Videos/Requests/UpdateVideoRequestTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit test for json resource', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'UserResource')
        ->expectsOutputToContain('The Tests\\Unit\\App\\Admin\\Resources\\User\\UserResourceTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/App/Admin/Resources/User/UserResourceTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit test for middleware', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'RedirectIfAuthenticated')
        ->expectsOutputToContain('The Tests\\Unit\\Support\\Http\\Middleware\\RedirectIfAuthenticatedTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/Support/Http/Middleware/RedirectIfAuthenticatedTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit test for listener', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'IncrementUserStatistics')
        ->expectsOutputToContain('The Tests\\Unit\\Domain\\User\\Listeners\\IncrementUserStatisticsTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/Domain/User/Listeners/IncrementUserStatisticsTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
