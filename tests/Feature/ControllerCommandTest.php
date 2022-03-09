<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\ControllerCommand
 */
class ControllerCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theControllerIsCorrectlyCreated(): void
    {
        $this->artisan('somake:controller')
            ->expectsQuestion('What is the Controller name ?', 'PostController')
            ->expectsOutput('I detected 3 applications.')
            ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
            ->expectsQuestion('What is the Application ?', 'Website/Blog')
            ->expectsQuestion(
                'You may want PostController to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
                null
            )
            ->expectsOutput('The App\\Website\\Blog\\Controllers\\PostController class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Website/Blog/Controllers/PostController.php'));

        $this->assertFileEquals(
            $this->expectedPath('Controllers/PostController.php.stub'),
            $this->app->basePath('app/App/Website/Blog/Controllers/PostController.php')
        );
    }

    /**
     * @test
     */
    public function theControllerCanLiveInSubNamespace(): void
    {
        $this->artisan('somake:controller')
            ->expectsQuestion('What is the Controller name ?', 'LoginController')
            ->expectsOutput('I detected 3 applications.')
            ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
            ->expectsQuestion('What is the Application ?', 'Admin')
            ->expectsQuestion(
                'You may want LoginController to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
                'Auth'
            )
            ->expectsOutput('The App\\Admin\\Controllers\\Auth\\LoginController class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Admin/Controllers/Auth/LoginController.php'));

        $this->assertFileEquals(
            $this->expectedPath('Controllers/LoginController.php.stub'),
            $this->app->basePath('app/App/Admin/Controllers/Auth/LoginController.php')
        );
    }
}
