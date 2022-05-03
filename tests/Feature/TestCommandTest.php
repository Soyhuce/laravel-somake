<?php declare(strict_types=1);

it('creates correctly the contract test', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Contract')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', 'update')
        ->expectsQuestion('What is the Test name ?', 'ContractUpdateVideoTest')
        ->expectsOutput('The Tests\\Contract\\Website\\Videos\\Video\\ContractUpdateVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Contract/Website/Videos/Video/ContractUpdateVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the contract test with custom base class', function (): void {
    config()->set('somake.base_classes.test_contract', 'Tests\\ContractTestCase');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Contract')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', null)
        ->expectsQuestion('What is the Test name ?', 'ContractShowVideoTest')
        ->expectsOutput('The Tests\\Contract\\Website\\Videos\\Video\\ContractShowVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Contract/Website/Videos/Video/ContractShowVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the contract pest', function (): void {
    file_put_contents(base_path('tests/Pest.php'), '');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Contract')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', 'update')
        ->expectsQuestion('What is the Test name ?', 'ContractUpdateVideoTest')
        ->expectsOutput('The Tests\\Contract\\Website\\Videos\\Video\\ContractUpdateVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Contract/Website/Videos/Video/ContractUpdateVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the feature test', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', null)
        ->expectsQuestion('What is the Test name ?', 'ShowVideoTest')
        ->expectsOutput('The Tests\\Feature\\Website\\Videos\\VideoController\\ShowVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the feature test with custom base class', function (): void {
    config()->set('somake.base_classes.test_feature', 'Tests\\FeatureTestCase');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', null)
        ->expectsQuestion('What is the Test name ?', 'ShowVideoTest')
        ->expectsOutput('The Tests\\Feature\\Website\\Videos\\VideoController\\ShowVideoTest class was successfully created !')
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
        ->expectsOutput('The Tests\\Feature\\Website\\Videos\\VideoController\\IndexVideosTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Feature/Website/Videos/VideoController/IndexVideosTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the feature pest', function (): void {
    file_put_contents(base_path('tests/Pest.php'), '');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
        ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
        ->expectsQuestion('Which method do you want to cover ?', null)
        ->expectsQuestion('What is the Test name ?', 'ShowVideoTest')
        ->expectsOutput('The Tests\\Feature\\Website\\Videos\\VideoController\\ShowVideoTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit test', function (): void {
    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'User')
        ->expectsOutput('The Tests\\Unit\\Domain\\User\\Models\\UserTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit testwith custom base class', function (): void {
    config()->set('somake.base_classes.test_unit', 'Tests\\UnitTestCase');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'User')
        ->expectsOutput('The Tests\\Unit\\Domain\\User\\Models\\UserTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('creates correctly the unit pest', function (): void {
    file_put_contents(base_path('tests/Pest.php'), '');

    $this->artisan('somake:test')
        ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
        ->expectsQuestion('Which class do you want to cover ?', 'User')
        ->expectsOutput('The Tests\\Unit\\Domain\\User\\Models\\UserTest class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
