<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\DTO;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;

class DTOClass
{
    /** @var ReflectionClass<\Spatie\DataTransferObject\DataTransferObject> */
    protected ReflectionClass $dtoClass;

    /**
     * @param class-string<\Spatie\DataTransferObject\DataTransferObject> $dtoClass
     */
    public function __construct(string $dtoClass)
    {
        $this->dtoClass = new ReflectionClass($dtoClass);
    }

    /**
     * @param class-string<\Spatie\DataTransferObject\DataTransferObject> $dtoClass
     */
    public static function from(string $dtoClass): self
    {
        return new self($dtoClass);
    }

    /**
     * @return \Illuminate\Support\Collection<int, \Soyhuce\Somake\Domains\DTO\DTOProperty>
     */
    public function properties(): Collection
    {
        return collect($this->dtoClass->getProperties(ReflectionProperty::IS_PUBLIC))
            ->filter(fn (ReflectionProperty $property) => !$property->isStatic())
            ->map(fn (ReflectionProperty $property) => new DTOProperty($property))
            ->values();
    }
}
