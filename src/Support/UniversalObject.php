<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

class UniversalObject
{
    /**
     * @param array<array-key, mixed> $arguments
     */
    public function __call(string $name, array $arguments): mixed
    {
        return null;
    }

    /**
     * @param array<array-key, mixed> $arguments
     */
    public static function __callStatic(string $name, array $arguments): mixed
    {
        return null;
    }

    public function __get(string $name): mixed
    {
        return null;
    }
}
