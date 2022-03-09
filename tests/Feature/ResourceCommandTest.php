<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\ResourceCommand
 */
class ResourceCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theResourceIsCorrectlyCreated(): void
    {
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

        $this->assertFileExists($this->app->basePath('app/App/Admin/Resources/User/UserResource.php'));

        $this->assertFileEquals(
            $this->expectedPath('Resources/UserResource.php.stub'),
            $this->app->basePath('app/App/Admin/Resources/User/UserResource.php')
        );
    }
}
