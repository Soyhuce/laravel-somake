<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

use Composer\ClassMapGenerator\ClassMapGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;
use Throwable;

class Finder
{
    protected Composer $composer;

    protected ?string $applicationRootPath = null;

    protected ?string $domainRootPath = null;

    protected ?string $supportRootPath = null;

    public function __construct(Composer $composer)
    {
        $this->composer = $composer;
    }

    /**
     * @return \Illuminate\Support\Collection<int, string>
     */
    public function domains(): Collection
    {
        return collect(File::directories($this->domainPath('/')))
            ->map(fn (string $path): string => basename($path));
    }

    public function domainPath(string $path): string
    {
        return mb_rtrim($this->domainRootPath() . Str::start($path, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
    }

    private function domainRootPath(): string
    {
        return $this->domainRootPath ??= $this->composer->findPath('Domain');
    }

    /**
     * @return \Illuminate\Support\Collection<int, string>
     */
    public function applications(): Collection
    {
        return $this->findApplications($this->applicationRootPath())
            ->map(fn (string $path) => Str::after($path, $this->applicationRootPath() . DIRECTORY_SEPARATOR));
    }

    public function applicationPath(string $path): string
    {
        return mb_rtrim($this->applicationRootPath() . Str::start($path, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
    }

    /**
     * @return \Illuminate\Support\Collection<int, string>
     */
    private function findApplications(string $path): Collection
    {
        $applicationPaths = new Collection();

        if (!File::isDirectory($path)) {
            return $applicationPaths;
        }

        if (File::isDirectory($path . DIRECTORY_SEPARATOR . 'Controllers')) {
            return $applicationPaths->add($path);
        }

        foreach (File::directories($path) as $subdirectory) {
            $applicationPaths = $applicationPaths->merge($this->findApplications($subdirectory));
        }

        return $applicationPaths;
    }

    private function applicationRootPath(): string
    {
        return $this->applicationRootPath ??= $this->composer->findPath('App');
    }

    public function supportRootPath(): string
    {
        return $this->supportRootPath ??= $this->composer->findPath('Support');
    }

    /**
     * @return \Illuminate\Support\Collection<int, class-string>
     */
    public function events(): Collection
    {
        return Collection::make(File::glob($this->domainPath('*/Events')))
            ->flatMap(fn (string $path) => array_keys(ClassMapGenerator::createMap($path)))
            ->filter(function (string $class) {
                try {
                    return class_exists($class);
                } catch (Throwable) {
                    return false;
                }
            })
            ->values();
    }

    /**
     * @return \Illuminate\Support\Collection<int, class-string<\Illuminate\Database\Eloquent\Model>>
     */
    public function models(): Collection
    {
        return collect(ClassMapGenerator::createMap($this->domainRootPath()))
            ->keys()
            ->filter(fn (string $class) => class_exists($class) && is_a($class, Model::class, true))
            ->values();
    }

    /**
     * @return \Illuminate\Support\Collection<int, class-string<\Spatie\LaravelData\Data>>
     */
    public function datas(): Collection
    {
        return collect(ClassMapGenerator::createMap($this->domainRootPath()))
            ->keys()
            ->filter(fn (string $class) => class_exists($class) && is_a($class, Data::class, true))
            ->values();
    }

    /**
     * @return \Illuminate\Support\Collection<int, class-string>
     */
    public function classes(): Collection
    {
        return collect([$this->applicationRootPath(), $this->domainRootPath(), $this->supportRootPath()])
            ->flatMap(fn (string $path) => array_keys(ClassMapGenerator::createMap($path)))
            ->filter(function (string $class) {
                try {
                    return class_exists($class) || trait_exists($class);
                } catch (Throwable) {
                    return false;
                }
            })
            ->values();
    }

    /**
     * @return \Illuminate\Support\Collection<int, class-string>
     */
    public function controllers(): Collection
    {
        return collect(ClassMapGenerator::createMap($this->applicationRootPath()))
            ->keys()
            ->filter(fn (string $class) => Str::contains($class, '\\Controllers\\'))
            ->values();
    }
}
