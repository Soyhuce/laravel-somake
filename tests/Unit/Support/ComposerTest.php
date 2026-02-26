<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Unit\Support;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Somake\Support\Composer;
use Soyhuce\Somake\Tests\TestCase;

#[CoversClass(Composer::class)]
class ComposerTest extends TestCase
{
    #[Test]
    public function pathOfNamespaceIsFound(): void
    {
        $composer = new Composer();

        $this->assertEquals(
            $this->app->basePath('app/Domain'),
            $composer->findPath('Domain')
        );

        $this->assertEquals(
            $this->app->basePath('app/Domain/User/Models'),
            $composer->findPath('Domain\\User\\Models')
        );

        $this->assertEquals(
            $this->app->basePath('app/Domain/Blog/Models'),
            $composer->findPath('Domain\\Blog\\Models')
        );
    }

    #[Test]
    public function namespaceOrPathIsFound(): void
    {
        $composer = new Composer();

        $this->assertEquals(
            'Domain',
            $composer->findNamespace($this->app->basePath('app/Domain'))
        );
        $this->assertEquals(
            'Domain\\Blog\\Models',
            $composer->findNamespace($this->app->basePath('app/Domain/Blog/Models'))
        );
        $this->assertEquals(
            'Domain\\Blog\\Models',
            $composer->findNamespace($this->app->basePath('app/Domain/Blog/Models/Post.php'))
        );
    }
}
