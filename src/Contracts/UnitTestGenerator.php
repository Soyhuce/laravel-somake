<?php declare(strict_types=1);

namespace Soyhuce\Somake\Contracts;

use Soyhuce\Somake\Domains\Test\TestFile;

/**
 * @template TClass
 */
interface UnitTestGenerator
{
    /**
     * @param class-string $class
     */
    public static function shouldHandle(string $class): bool;

    /**
     * @param class-string<TClass> $class
     */
    public function generate(string $class): TestFile;
}
