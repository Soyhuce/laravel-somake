<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests;

use ErrorException;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDeprecationHandling;
use Orchestra\Testbench\Foundation\PackageManifest;
use Orchestra\Testbench\TestCase as Orchestra;
use PHPUnit\Framework\Attributes\CoversNothing;
use Soyhuce\Somake\SomakeServiceProvider;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Support\BaseApplication;
use function in_array;

#[CoversNothing]
class TestCase extends Orchestra
{
    use InteractsWithDeprecationHandling;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutDeprecationHandling();

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
            LaravelDataServiceProvider::class,
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

    protected function withoutDeprecationHandling(): static
    {
        if ($this->originalDeprecationHandler == null) {
            $this->originalDeprecationHandler = set_error_handler(function (
                $level,
                $message,
                $file = '',
                $line = 0,
            ): void {
                if (in_array($level, [E_DEPRECATED, E_USER_DEPRECATED], true) || (error_reporting() & $level)) {
                    // Silenced vendor errors
                    if (str_starts_with($file, base_path('vendor/symfony/'))) {
                        return;
                    }

                    if (str_starts_with($file, realpath(__DIR__ . '/../vendor/composer/pcre'))) {
                        return;
                    }

                    throw new ErrorException($message, 0, $level, $file, $line);
                }
            });
        }

        return $this;
    }
}
