<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Unit\Support;

use Domain\User\Data\UserData;
use Domain\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Somake\Support\Composer;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Tests\TestCase;

#[CoversClass(Finder::class)]
class FinderTest extends TestCase
{
    #[Test]
    public function domainsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(['User'], $finder->domains()->all());
    }

    #[Test]
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

    #[Test]
    public function modelsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            [User::class],
            $finder->models()->all()
        );
    }

    #[Test]
    public function dataObjectsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            [UserData::class],
            $finder->datas()->all()
        );
    }

    #[Test]
    public function applicationsAreCorrectlyResolved(): void
    {
        $finder = new Finder(new Composer());

        $this->assertEquals(
            ['Admin', 'Website/Blog', 'Website/Videos'],
            $finder->applications()->all()
        );
    }
}
