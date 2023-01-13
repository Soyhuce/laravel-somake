<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

class TestFunction
{
    public function __construct(
        public readonly string $description,
        public readonly string $callback,
    ) {
    }

    public function __toString(): string
    {
        return <<<PHP
        it('{$this->description}', {$this->callback});
        PHP;
    }
}
