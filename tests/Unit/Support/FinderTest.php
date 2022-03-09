<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Unit\Support;

use Domain\User\DTO\UserDTO;
use Domain\User\Models\User;
use Soyhuce\Somake\Support\Composer;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Tests\TestCase;

/**
 * @covers \Soyhuce\Somake\Support\Finder
 */
class FinderTest extends TestCase
{
    /**
     * @test
     */
    public function domainsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(['User'], $finder->domains()->all());
    }

    /**
     * @test
     */
    public function domainPathAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            realpath(__DIR__ . '/../../../test-laravel/app/Domain'),
            $finder->domainPath('/')
        );

        $this->assertEquals(
            realpath(__DIR__ . '/../../../test-laravel/app/Domain/User/Models'),
            $finder->domainPath('User/Models')
        );
    }

    /**
     * @test
     */
    public function modelsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            [User::class],
            $finder->models()->all()
        );
    }

    /**
     * @test
     */
    public function dataTransferObjectsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            [UserDTO::class],
            $finder->dtos()->all()
        );
    }

    /**
     * @test
     */
    public function applicationsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            ['Admin', 'Website/Blog', 'Website/Videos'],
            $finder->applications()->all()
        );
    }
}
