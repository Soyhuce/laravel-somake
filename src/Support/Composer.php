<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Str;
use Soyhuce\Somake\Exceptions\PSR4NamespaceNotFound;
use Soyhuce\Somake\Exceptions\PSR4PathNotFound;
use function dirname;
use function is_bool;

class Composer
{
    protected ClassLoader $classLoader;

    public function __construct()
    {
        $this->classLoader = require base_path('vendor/autoload.php');
    }

    /**
     * @throws \Soyhuce\Somake\Exceptions\PSR4NamespaceNotFound
     */
    public function findPath(string $namespace): string
    {
        $namespace = (string) Str::of($namespace)->ltrim('\\')->finish('\\');

        [$rootNamespace, $path] = collect($this->classLoader->getPrefixesPsr4())
            ->map(fn ($paths, $root) => [$root, $paths[0]])
            ->first(
                fn ($entry) => Str::startsWith($namespace, $entry[0]),
                fn () => throw PSR4NamespaceNotFound::make($namespace)
            );

        $suffix = (string) Str::of($namespace)->after($rootNamespace)->replace('\\', DIRECTORY_SEPARATOR);

        return rtrim(realpath($path) . DIRECTORY_SEPARATOR . $suffix, DIRECTORY_SEPARATOR);
    }

    /**
     * @throws \Soyhuce\Somake\Exceptions\PSR4PathNotFound
     */
    public function findNamespace(string $path): string
    {
        if (pathinfo($path, PATHINFO_EXTENSION)) {
            $path = dirname($path);
        }

        [$rootNamespace, $rootPath] = collect($this->classLoader->getPrefixesPsr4())
            ->map(fn ($paths, $root) => [$root, realpath($paths[0])])
            ->filter(fn ($entry) => !is_bool($entry[1]))
            ->first(
                fn ($entry) => Str::startsWith($path, $entry[1]),
                fn () => throw PSR4PathNotFound::make($path)
            );

        $suffix = (string) Str::of($path)->after($rootPath)->replace(DIRECTORY_SEPARATOR, '\\');

        return rtrim(rtrim($rootNamespace, '\\') . $suffix, '\\');
    }
}
