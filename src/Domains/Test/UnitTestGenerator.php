<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

use Illuminate\Support\Collection;
use LogicException;
use Soyhuce\Somake\Contracts\UnitTestGenerator as UnitTestGeneratorContract;

class UnitTestGenerator
{
    /**
     * @param class-string $covers
     */
    public function __construct(
        public readonly string $covers,
    ) {
    }

    public function generate(): TestFile
    {
        $generator = Collection::make(config('somake.test_generators'))
            ->each(fn (string $generator) => throw_if(
                !is_subclass_of($generator, UnitTestGeneratorContract::class),
                new LogicException("{$generator} must implement UnitTestGenerator")
            ))
            ->first(fn ($generator) => $generator::shouldHandle($this->covers));

        return app($generator)->generate($this->covers);
    }
}
