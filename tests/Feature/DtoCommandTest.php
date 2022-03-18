<?php declare(strict_types=1);

it('creates the dto correctly', function (): void {
    $this->artisan('somake:dto')
        ->expectsQuestion('What is the DTO name ?', 'CreatePostDTO')
        ->expectsOutput('I detected 1 domain.')
        ->expectsTable(['Domain'], [['User']])
        ->expectsQuestion('What is the Domain ?', 'Blog')
        ->expectsOutput('The Domain\\Blog\\DTO\\CreatePostDTO class was successfully created !')
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Domain/Blog/DTO/CreatePostDTO.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
