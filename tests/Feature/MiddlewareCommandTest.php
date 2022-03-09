<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\MiddlewareCommand
 */
class MiddlewareCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theMiddlewareIsCorrectlyCreated(): void
    {
        $this->artisan('somake:middleware')
            ->expectsQuestion('What is the Middleware name ?', 'FilterUnpublished')
            ->expectsOutput('I detected 3 applications.')
            ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
            ->expectsQuestion('What is the Application ?', 'Website/Blog')
            ->expectsQuestion(
                'You may want FilterUnpublished to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
                null
            )
            ->expectsOutput('The App\\Website\\Blog\\Middlewares\\FilterUnpublished class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for App\\Website\\Blog\\Middlewares\\FilterUnpublished ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Website/Blog/Middlewares/FilterUnpublished.php'));

        $this->assertFileEquals(
            $this->expectedPath('Middlewares/FilterUnpublished.php.stub'),
            $this->app->basePath('app/App/Website/Blog/Middlewares/FilterUnpublished.php')
        );
    }

    /**
     * @test
     */
    public function theMiddlewareCanLiveInSubNamespace(): void
    {
        $this->artisan('somake:middleware')
            ->expectsQuestion('What is the Middleware name ?', 'OnlySuperAdmin')
            ->expectsOutput('I detected 3 applications.')
            ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
            ->expectsQuestion('What is the Application ?', 'Admin')
            ->expectsQuestion(
                'You may want OnlySuperAdmin to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
                'Auth'
            )
            ->expectsOutput('The App\\Admin\\Middlewares\\Auth\\OnlySuperAdmin class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Middlewares\\Auth\\OnlySuperAdmin ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Admin/Middlewares/Auth/OnlySuperAdmin.php'));

        $this->assertFileEquals(
            $this->expectedPath('Middlewares/OnlySuperAdmin.php.stub'),
            $this->app->basePath('app/App/Admin/Middlewares/Auth/OnlySuperAdmin.php')
        );
    }
}
