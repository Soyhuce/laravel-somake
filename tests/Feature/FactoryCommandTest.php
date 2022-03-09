<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\FactoryCommand
 */
class FactoryCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theModelIsCorrectlyCreated(): void
    {
        $this->artisan('somake:factory')
            ->expectsQuestion('What is the Model ?', 'User')
            ->expectsOutput('The Database\\Factories\\User\\UserFactory class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('database/factories/User/UserFactory.php'));

        $this->assertFileEquals(
            $this->expectedPath('Factories/UserFactory.php.stub'),
            $this->app->basePath('database/factories/User/UserFactory.php')
        );
    }
}
