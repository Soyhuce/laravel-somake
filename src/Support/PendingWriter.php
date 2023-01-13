<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Soyhuce\Somake\Exceptions\PSR4NamespaceNotFound;
use Soyhuce\Somake\Exceptions\PSR4PathNotFound;
use function dirname;

class PendingWriter
{
    protected Composer $composer;

    protected string $stub;

    /** @var \Illuminate\Support\Collection<string, mixed> */
    protected Collection $data;

    /**
     * @param array<string, string> $data
     */
    public function __construct(Composer $composer, string $stub, array $data)
    {
        $this->composer = $composer;
        $this->stub = $stub;
        $this->data = collect($data);
    }

    public function toPath(string $path): void
    {
        $this->data->put('namespace', $this->findNamespace($path));

        $this->createDirectoryIfMissing(dirname($path));
        File::put($path, $this->fileContent());

        Event::dispatch(new FileWritten($path));
    }

    public function withBaseClass(?string $baseClass): static
    {
        $this->data->put('baseClass', $baseClass);
        $this->data->put('baseClassName', $baseClass == null  ? null :  class_basename($baseClass));

        return $this;
    }

    protected function findNamespace(string $path): ?string
    {
        try {
            return $this->composer->findNamespace($path);
        } catch (PSR4PathNotFound) {
            return null;
        }
    }

    public function toClass(string $class): void
    {
        $className = class_basename($class);
        $namespace = Str::beforeLast($class, '\\' . $className);

        $this->data->put('className', $className);
        $this->data->put('namespace', $namespace);

        $path = $this->findClassPath($class);
        $this->createDirectoryIfMissing(dirname($path));

        File::put($path, $this->fileContent());

        Event::dispatch(new FileWritten($path));
    }

    public function inClass(string $class): void
    {
        $path = $this->findClassPath($class);

        $originalContent = File::get($path);
        $partial = $this->fileContent(withHeader: false);

        $newContent = preg_replace(
            '/(.*)}$/s',
            '\1' . PHP_EOL . '    ' . $partial . '}',
            $originalContent
        );

        File::put($path, $newContent ?? $originalContent);
        Event::dispatch(new FileWritten($path));
    }

    private function findPath(string $namespace): ?string
    {
        try {
            return $this->composer->findPath($namespace);
        } catch (PSR4NamespaceNotFound) {
            return null;
        }
    }

    private function findClassPath(string $class): string
    {
        $className = class_basename($class);
        $namespace = Str::beforeLast($class, '\\' . $className);

        return $this->findPath($namespace) . "/{$className}.php";
    }

    private function fileContent(bool $withHeader = true): string
    {
        if (!$withHeader) {
            return Str::removeExtraBlankLines(view("somake::{$this->stub}", $this->data)->render());
        }

        return Str::removeExtraBlankLines($this->phpHeader() . view("somake::{$this->stub}", $this->data)->render());
    }

    private function phpHeader(): string
    {
        return '<?php' . PHP_EOL . PHP_EOL;
    }

    protected function createDirectoryIfMissing(string $directory): void
    {
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, recursive: true);
        }

        File::ensureDirectoryExists($directory);
    }
}
