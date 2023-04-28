<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Closure;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionNamedType;
use Soyhuce\Somake\Contracts\UnitTestGenerator;
use function count;

/**
 * @implements \Soyhuce\Somake\Contracts\UnitTestGenerator<mixed>
 */
class MiddlewareTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        if (!class_exists($class)) {
            return false;
        }

        $reflectionClass = new ReflectionClass($class);
        if (!$reflectionClass->hasMethod('handle')) {
            return false;
        }

        $parameters = $reflectionClass->getMethod('handle')->getParameters();
        if (count($parameters) < 2) {
            return false;
        }

        if (!$parameters[0]->getType() instanceof ReflectionNamedType || $parameters[0]->getType()->getName() !== Request::class) {
            return false;
        }

        if (!$parameters[1]->getType() instanceof ReflectionNamedType || $parameters[1]->getType()->getName() !== Closure::class) {
            return false;
        }

        return true;
    }

    public function view(): string
    {
        return 'test-unit-middleware';
    }

    public function data(string $class): array
    {
        return [];
    }
}
