<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Illuminate\Support\Str;
use ReflectionClass;
use Soyhuce\Somake\Contracts\UnitTestGenerator;

/**
 * @implements \Soyhuce\Somake\Contracts\UnitTestGenerator<mixed>
 */
class NotificationTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        if (!class_exists($class)) {
            return false;
        }

        if (!Str::is('Domain\\*\\Notifications\\*', $class)) {
            return false;
        }

        $reflectionClass = new ReflectionClass($class);

        return $reflectionClass->hasMethod('toMail');
    }

    public function view(): string
    {
        return 'test-unit-notification';
    }

    public function data(string $class): array
    {
        return [];
    }
}
