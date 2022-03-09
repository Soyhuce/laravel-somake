<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\ModelCommand
 */
class ModelCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theModelIsCorrectlyCreated(): void
    {
        $this->artisan('somake:model')
            ->expectsQuestion('What is the Model name ?', 'Post')
            ->expectsOutput('I detected 1 domain.')
            ->expectsTable(['Domain'], [['User']])
            ->expectsQuestion('What is the Domain ?', 'Blog')
            ->expectsOutput('The Domain\\Blog\\Models\\Post class was successfully created !')
            ->expectsQuestion('Do you want to create the model factory ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/Domain/Blog/Models/Post.php'));

        $this->assertFileEquals(
            $this->expectedPath('Models/Post.php.stub'),
            $this->app->basePath('app/Domain/Blog/Models/Post.php')
        );
    }
}
