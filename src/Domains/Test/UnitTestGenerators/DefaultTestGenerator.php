<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Soyhuce\Somake\Contracts\UnitTestGenerator;
use Soyhuce\Somake\Domains\Test\TestFile;
use Soyhuce\Somake\Domains\Test\TestFunction;

/**
 * @implements UnitTestGenerator<mixed>
 */
class DefaultTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        return true;
    }

    public function generate(string $class): TestFile
    {
        return TestFile::new()
            ->covers($class)
            ->addTest(new TestFunction(
                'is successful',
                <<<'PHP'
                function (): void {
                }
                PHP
            ));
    }
}
