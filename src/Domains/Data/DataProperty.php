<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Data;

use Illuminate\Support\Collection;
use LogicException;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

class DataProperty extends \Soyhuce\Somake\Domains\DTO\DTOProperty
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
     * @return \Illuminate\Support\Collection<int, ReflectionNamedType>
     */
    public function types(): Collection
    {
        $type = $this->property->getType();

        if (!$type) {
            return new Collection();
        }

        return match ($type::class) {
            ReflectionNamedType::class => collect([$type]),
            ReflectionUnionType::class => collect($type->getTypes()),
            default => throw new LogicException($type::class . ' is not supported'),
        };
    }
}
