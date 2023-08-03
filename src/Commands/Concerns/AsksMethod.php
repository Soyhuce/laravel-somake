<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionMethod;
use function Laravel\Prompts\suggest;

trait AsksMethod
{
    /**
     * @param class-string $class
     */
    private function askMethod(string $question, string $class): string
    {
        $methods = Collection::make(
            (new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC)
        )
            ->reject(fn (ReflectionMethod $method) => $method->getName() === '__construct')
            ->reject(fn (ReflectionMethod $method) => $method->isAbstract() || $method->isStatic())
            ->map(fn (ReflectionMethod $method) => $method->getName())
            ->sort();

        return suggest(
            label: $question,
            options: $methods,
            required: true
        );
    }
}
