<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\CommandCommand
 */
class CommandCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theCommandIsCorrectlyCreated(): void
    {
        $this->artisan('somake:command')
            ->expectsQuestion('What is the Command name ?', 'ConvertModels')
            ->expectsOutput('The App\\Commands\\ConvertModels class was successfully created !')
            ->expectsQuestion('Do you want to create a Unit Test for App\\Commands\\ConvertModels ?', false)
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/App/Commands/ConvertModels.php'));

        $this->assertFileEquals(
            $this->expectedPath('Commands/ConvertModels.php.stub'),
            $this->app->basePath('app/App/Commands/ConvertModels.php')
        );
    }
}
