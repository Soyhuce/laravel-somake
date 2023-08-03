<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use function Laravel\Prompts\confirm;

trait CreatesAssociatedUnitTest
{
    use StartsArtisan;

    protected function createUnitTest(string $class): void
    {
        if (!confirm("Do you want to create a Unit Test for {$class} ?")) {
            return;
        }

        $this->startArtisanProcess('somake:test --type=Unit --class=' . str_replace('\\', '\\\\', $class));
    }
}
