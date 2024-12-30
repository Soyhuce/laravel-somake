<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

use Illuminate\Support\Collection;
use LogicException;
use Soyhuce\Somake\Contracts\UnitTestGenerator as UnitTestGeneratorContract;

/**
 * @template TClass
 */
class UnitTestGenerator
{
    /** @var \Soyhuce\Somake\Contracts\UnitTestGenerator<TClass> */
    protected UnitTestGeneratorContract $generator;

    /**
     * @param class-string<TClass> $class
     */
    public function __construct(
        public string $class,
    ) {
        $generatorClass = Collection::make(config('somake.test_generators'))
            ->each(fn (string $generator) => throw_if(
                !is_subclass_of($generator, UnitTestGeneratorContract::class),
                new LogicException("{$generator} must implement UnitTestGenerator")
            ))
            ->first(
                fn (string $generator) => $generator::shouldHandle($this->class),
                fn () => throw new LogicException("No generator found for {$this->class}")
            );

        $this->generator = app($generatorClass);
    }

    public function view(): string
    {
        return $this->generator->view();
    }

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [
            'covered' => $this->class,
            'classFqcn' => $this->class,
            'classBasename' => class_basename($this->class),
            ...$this->generator->data($this->class),
        ];
    }
}
