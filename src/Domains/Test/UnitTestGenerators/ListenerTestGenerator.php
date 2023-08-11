<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Illuminate\Support\Reflector;
use Illuminate\Support\Str;
use ReflectionClass;
use Soyhuce\Somake\Contracts\UnitTestGenerator;

/**
 * @implements \Soyhuce\Somake\Contracts\UnitTestGenerator<mixed>
 */
class ListenerTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        if (!class_exists($class)) {
            return false;
        }

        if (!Str::is('Domain\\*\\Listeners\\*', $class)) {
            return false;
        }

        $reflectionClass = new ReflectionClass($class);

        return $reflectionClass->hasMethod('handle');
    }

    public function view(): string
    {
        return 'test-unit-listener';
    }

    public function data(string $class): array
    {
        $eventFqcn = $this->event($class);

        return [
            'eventFqcn' => $eventFqcn,
            'event' => $eventFqcn !== null ? class_basename($eventFqcn) : 'MyEvent',
        ];
    }

    private function event(string $class): ?string
    {
        $reflectionClass = new ReflectionClass($class);
        $method = $reflectionClass->getMethod('handle');

        return Reflector::getParameterClassName($method->getParameters()[0]);
    }
}
