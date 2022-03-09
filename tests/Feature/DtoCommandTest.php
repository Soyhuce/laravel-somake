<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Commands\DtoCommand
 */
class DtoCommandTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theActionIsCorrectlyCreated(): void
    {
        $this->artisan('somake:dto')
            ->expectsQuestion('What is the DTO name ?', 'CreatePostDTO')
            ->expectsOutput('I detected 1 domain.')
            ->expectsTable(['Domain'], [['User']])
            ->expectsQuestion('What is the Domain ?', 'Blog')
            ->expectsOutput('The Domain\\Blog\\DTO\\CreatePostDTO class was successfully created !')
            ->assertExitCode(0)
            ->execute();

        $this->assertFileExists($this->app->basePath('app/Domain/Blog/DTO/CreatePostDTO.php'));

        $this->assertFileEquals(
            $this->expectedPath('Dto/CreatePostDTO.php.stub'),
            $this->app->basePath('app/Domain/Blog/DTO/CreatePostDTO.php')
        );
    }
}
