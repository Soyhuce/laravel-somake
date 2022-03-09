<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\ActionCommand
 */
class ActionCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theActionIsCorrectlyCreated(): void
    {
        $this->artisan('somake:action')
            ->expectsQuestion('What is the Action name ?', 'CreatePost')
            ->expectsOutput('I detected 1 domain.')
            ->expectsTable(['Domain'], [['User']])
            ->expectsQuestion('What is the Domain ?', 'Blog')
            ->expectsOutput('The Domain\\Blog\\Actions\\CreatePost class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for Domain\\Blog\\Actions\\CreatePost ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/Domain/Blog/Actions/CreatePost.php'));

        $this->assertFileEquals(
            $this->expectedPath('Actions/CreatePost.php.stub'),
            $this->app->basePath('app/Domain/Blog/Actions/CreatePost.php')
        );
    }
}
