<?php declare(strict_types=1);

it('creates the model correctly', function (): void {
    $this->artisan('somake:model')
        ->expectsQuestion('What is the Model name ?', 'Post')
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutputToContain('The Domain\\Blog\\Models\\Post class was successfully created !')
        ->expectsQuestion('Do you want to create the model factory ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/Models/Post.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
