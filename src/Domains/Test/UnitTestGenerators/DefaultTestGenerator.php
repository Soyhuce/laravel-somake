<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Soyhuce\Somake\Contracts\UnitTestGenerator;

/**
 * @implements UnitTestGenerator<mixed>
 */
class DefaultTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        return true;
    }

    public function view(): string
    {
        return 'test-unit';
    }

    public function data(string $class): array
    {
        return [
            'covered' => $class,
        ];
    }
}
