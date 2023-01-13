<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

class UnitTestGenerator
{
    public function __construct(
        public readonly string $covers,
    ) {
    }

    public function generate(): TestFile
    {
        return TestFile::new()
            ->covers($this->covers)
            ->addTest(new TestFunction(
                'is successful',
                <<<'PHP'
                function (): void {
                }
                PHP
            ));
    }
}
