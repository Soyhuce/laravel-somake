<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Data;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;

class DataClass
{
    /** @var ReflectionClass<\Spatie\LaravelData\Data> */
    protected ReflectionClass $dataClass;

    /**
     * @param class-string<\Spatie\LaravelData\Data> $dataClass
     */
    public function __construct(string $dataClass)
    {
        $this->dataClass = new ReflectionClass($dataClass);
    }

    /**
     * @param class-string<\Spatie\LaravelData\Data> $dataClass
     */
    public static function from(string $dataClass): self
    {
        return new self($dataClass);
    }

    /**
     * @return \Illuminate\Support\Collection<int, \Soyhuce\Somake\Domains\Data\DataProperty>
     */
    public function properties(): Collection
    {
        return collect($this->dataClass->getProperties(ReflectionProperty::IS_PUBLIC))
            ->filter(fn (ReflectionProperty $property) => !$property->isStatic())
            ->map(fn (ReflectionProperty $property) => new DataProperty($property))
            ->values();
    }
}
