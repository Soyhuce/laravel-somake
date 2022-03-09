<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests;

use Orchestra\Testbench\Foundation\PackageManifest;
use Orchestra\Testbench\TestCase as Orchestra;
use Soyhuce\Somake\SomakeServiceProvider;
use Support\BaseApplication;

/**
 * @coversNothing
 */
class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        if (method_exists($this, 'bootApplicationRestoration')) {
            $this->bootApplicationRestoration();
        }
    }

    protected function resolveApplication()
    {
        return tap(new BaseApplication($this->getBasePath()), function ($app): void {
            PackageManifest::swap($app, $this);
        });
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array<string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            SomakeServiceProvider::class,
        ];
    }

    protected function getBasePath(): string
    {
        return realpath(__DIR__ . '/../vendor/test-laravel/test-laravel/');
    }

    protected function expectedPath(string $file): string
    {
        return realpath(__DIR__ . "/Expected/{$file}");
    }
}
