<?php declare(strict_types=1);

it('creates the data correctly', function (): void {
    $this->artisan('somake:data')
        ->expectsQuestion('What is the Data name ?', 'CreatePostData')
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutputToContain('The Domain\\Blog\\Data\\CreatePostData class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Data/CreatePostData.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
