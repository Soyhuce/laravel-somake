<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @coversNothing
 */
class PolicyCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theActionIsCorrectlyCreated(): void
    {
        $this->artisan('somake:policy')
            ->expectsQuestion('What is the Model ?', 'User')
            ->expectsOutput('The Domain\\User\\Policies\\UserPolicy class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for Domain\\User\\Policies\\UserPolicy ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/Domain/User/Policies/UserPolicy.php'));

        $this->assertFileEquals(
            $this->expectedPath('Policies/UserPolicy.php.stub'),
            $this->app->basePath('app/Domain/User/Policies/UserPolicy.php')
        );
    }
}
