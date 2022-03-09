<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\DTO;

use Illuminate\Support\Collection;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

class DTOProperty
{
    public function __construct(
        protected ReflectionProperty $property,
    ) {
    }

    public function name(): string
    {
        return $this->property->getName();
    }

    /**
     * @return \Illuminate\Support\Collection<string>
     */
    public function types(): Collection
    {
        $type = $this->property->getType();

        if (!$type) {
            return collect();
        }

        return match ($type::class) {
            ReflectionNamedType::class => collect([$type]),
            ReflectionUnionType::class => collect($type->getTypes()),
        };
    }
}
