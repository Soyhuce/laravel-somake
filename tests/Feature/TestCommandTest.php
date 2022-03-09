<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\TestCommand
 */
class TestCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theContractTestIsCorrectlyCreated(): void
    {
        $this->artisan('somake:test')
            ->expectsQuestion('Which kind of test do you want to create ?', 'Contract')
            ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
            ->expectsQuestion('What is the Test name ?', 'ContractShowVideoTest')
            ->expectsOutput('The Tests\\Contract\\Website\\Videos\\Video\\ContractShowVideoTest class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('tests/Contract/Website/Videos/Video/ContractShowVideoTest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Tests/ContractShowVideoTest.php.stub'),
            $this->app->basePath('tests/Contract/Website/Videos/Video/ContractShowVideoTest.php')
        );
    }

    /**
     * @test
     */
    public function theContractPestIsCorrectlyCreated(): void
    {
        file_put_contents(base_path('tests/Pest.php'), '');

        $this->artisan('somake:test')
            ->expectsQuestion('Which kind of test do you want to create ?', 'Contract')
            ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
            ->expectsQuestion('What is the Test name ?', 'ContractShowVideoTest')
            ->expectsOutput('The Tests\\Contract\\Website\\Videos\\Video\\ContractShowVideoTest class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('tests/Contract/Website/Videos/Video/ContractShowVideoTest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Pests/ContractShowVideoTest.php.stub'),
            $this->app->basePath('tests/Contract/Website/Videos/Video/ContractShowVideoTest.php')
        );
    }

    /**
     * @test
     */
    public function theFeatureTestIsCorrectlyCreated(): void
    {
        $this->artisan('somake:test')
            ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
            ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
            ->expectsQuestion('What is the Test name ?', 'ShowVideoTest')
            ->expectsOutput('The Tests\\Feature\\Website\\Videos\\VideoController\\ShowVideoTest class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Tests/ShowVideoTest.php.stub'),
            $this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php')
        );
    }

    /**
     * @test
     */
    public function theFeaturePestIsCorrectlyCreated(): void
    {
        file_put_contents(base_path('tests/Pest.php'), '');

        $this->artisan('somake:test')
            ->expectsQuestion('Which kind of test do you want to create ?', 'Feature')
            ->expectsQuestion('Which controller do you want to cover ?', 'VideoController')
            ->expectsQuestion('What is the Test name ?', 'ShowVideoTest')
            ->expectsOutput('The Tests\\Feature\\Website\\Videos\\VideoController\\ShowVideoTest class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Pests/ShowVideoTest.php.stub'),
            $this->app->basePath('tests/Feature/Website/Videos/VideoController/ShowVideoTest.php')
        );
    }

    /**
     * @test
     */
    public function theUnitTestIsCorrectlyCreated(): void
    {
        $this->artisan('somake:test')
            ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
            ->expectsQuestion('Which class do you want to cover ?', 'User')
            ->expectsOutput('The Tests\\Unit\\Domain\\User\\Models\\UserTest class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Tests/UserTest.php.stub'),
            $this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php')
        );
    }

    /**
     * @test
     */
    public function theUnitPestIsCorrectlyCreated(): void
    {
        file_put_contents(base_path('tests/Pest.php'), '');

        $this->artisan('somake:test')
            ->expectsQuestion('Which kind of test do you want to create ?', 'Unit')
            ->expectsQuestion('Which class do you want to cover ?', 'User')
            ->expectsOutput('The Tests\\Unit\\Domain\\User\\Models\\UserTest class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php'));

        $this->assertFileEquals(
            $this->expectedPath('Pests/UserTest.php.stub'),
            $this->app->basePath('tests/Unit/Domain/User/Models/UserTest.php')
        );
    }
}
