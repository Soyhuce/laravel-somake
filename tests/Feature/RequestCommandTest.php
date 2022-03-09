<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\RequestCommand
 */
class RequestCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theRequestIsCorrectlyCreated(): void
    {
        $this->artisan('somake:request')
            ->expectsQuestion('What is the Request name ?', 'LoginRequest')
            ->expectsOutput('I detected 3 applications.')
            ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
            ->expectsQuestion('What is the Application ?', 'Website/Auth')
            ->expectsQuestion(
                'You may want LoginRequest to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
                null
            )
            ->expectsQuestion('Do you want to fill the request with fields from a DTO ?', false)
            ->expectsOutput('The App\\Website\\Auth\\Requests\\LoginRequest class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for App\\Website\\Auth\\Requests\\LoginRequest ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Website/Auth/Requests/LoginRequest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Requests/LoginRequest.php.stub'),
            $this->app->basePath('app/App/Website/Auth/Requests/LoginRequest.php')
        );
    }

    /**
     * @test
     */
    public function theRequestCanBePrefilledWithDTOFields(): void
    {
        $this->artisan('somake:request')
            ->expectsQuestion('What is the Request name ?', 'UserRequest')
            ->expectsOutput('I detected 3 applications.')
            ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
            ->expectsQuestion('What is the Application ?', 'Admin')
            ->expectsQuestion(
                'You may want UserRequest to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
                null
            )
            ->expectsQuestion('Do you want to fill the request with fields from a DTO ?', true)
            ->expectsQuestion('What is the DTO ?', 'UserDTO')
            ->expectsOutput('The App\\Admin\\Requests\\UserRequest class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Requests\\UserRequest ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Admin/Requests/UserRequest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Requests/UserRequest.php.stub'),
            $this->app->basePath('app/App/Admin/Requests/UserRequest.php')
        );
    }
}
