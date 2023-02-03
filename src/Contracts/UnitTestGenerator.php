<?php declare(strict_types=1);

namespace Soyhuce\Somake\Contracts;

/**
 * @template TClass
 */
interface UnitTestGenerator
{
    /**
     * @param class-string $class
     */
    public static function shouldHandle(string $class): bool;

    public function view(): string;

    /**
     * @param class-string<TClass> $class
     * @return array<string, mixed>
     */
    public function data(string $class): array;
}
