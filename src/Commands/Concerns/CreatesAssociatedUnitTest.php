<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

trait CreatesAssociatedUnitTest
{
    use StartsArtisan;

    protected function createUnitTest(string $class): void
    {
        if (!$this->confirm("Do you want to create a Unit Test for {$class} ?", true)) {
            return;
        }

        $this->startArtisanProcess('somake:test --type=Unit --class=' . str_replace('\\', '\\\\', $class));
    }

    /**
     * @param string $question
     * @param bool $default
     * @return bool
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    abstract public function confirm($question, $default = false);
}
