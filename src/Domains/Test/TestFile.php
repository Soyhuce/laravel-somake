<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

class TestFile
{
    public ?string $covers = null;

    /** @var array<int, string> */
    public array $uses = [];

    /** @var array<int, \Soyhuce\Somake\Domains\Test\TestFunction> */
    public array $tests = [];

    final public function __construct()
    {
    }

    public static function new(): static
    {
        return new static();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'covers' => $this->covers,
            'uses' => $this->uses,
            'tests' => $this->tests,
        ];
    }

    public function covers(string $covers): static
    {
        $this->covers = $covers;

        return $this;
    }

    public function uses(string $use): static
    {
        $this->uses[] = $use;

        return $this;
    }

    public function addTest(TestFunction $testFunction): static
    {
        $this->tests[] = $testFunction;

        return $this;
    }
}
