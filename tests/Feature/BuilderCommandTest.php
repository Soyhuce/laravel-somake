<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\BuilderCommand
 */
class BuilderCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theBuilderIsCorrectlyCreated(): void
    {
        $this->artisan('somake:builder')
            ->expectsQuestion('What is the Model ?', 'User')
            ->expectsOutput('The Domain\\User\\Builders\\UserBuilder class was successfully created !')
            ->expectsQuestion('Do you want to add implementation of newEloquentBuilder in Domain\\User\\Models\\User ?', true)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/Domain/User/Builders/UserBuilder.php'));

        $this->assertFileEquals(
            $this->expectedPath('Builders/UserBuilder.php.stub'),
            $this->app->basePath('app/Domain/User/Builders/UserBuilder.php')
        );

        $this->assertFileEquals(
            $this->expectedPath('Builders/User.php.stub'),
            $this->app->basePath('app/Domain/User/Models/User.php')
        );
    }
}
