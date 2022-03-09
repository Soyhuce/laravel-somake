<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Request;

use Countable;
use DateTimeInterface;
use ReflectionNamedType;
use Soyhuce\Somake\Domains\DTO\DTOClass;
use Soyhuce\Somake\Domains\DTO\DTOProperty;
use function function_exists;

class Ruler
{
    /**
     * @return array<string, array<string>>
     */
    public function getRules(DTOProperty $property): array
    {
        $types = $property->types();
        if ($types->isEmpty() || $types->count() > 1) {
            return [$property->name() => []];
        }

        /** @var ReflectionNamedType $type */
        $type = $types->first();

        $rules = [$property->name() => $this->rulesFor($type, $property->name())];

        foreach ($this->nestedRules($type) as $key => $value) {
            $rules[$property->name() . '.' . $key] = $value;
        }

        return $rules;
    }

    /**
     * @return array<string>
     */
    protected function rulesFor(ReflectionNamedType $type, string $name): array
    {
        return [...$this->requirement($type, $name), ...$this->rules($type->getName())];
    }

    /**
     * @return array<string, array<string>>
     */
    protected function nestedRules(ReflectionNamedType $type): array
    {
        if (!is_a($type->getName(), \Spatie\DataTransferObject\DataTransferObject::class, true)) {
            return [];
        }

        return DTOClass::from($type->getName())
            ->properties()
            ->flatMap(fn (DTOProperty $property) => $this->getRules($property))
            ->all();
    }

    /**
     * @return array<string>
     */
    protected function requirement(ReflectionNamedType $type, string $name): array
    {
        $typeName = $type->getName();

        return match (true) {
            $typeName === 'array',
            is_a($typeName, Countable::class, true) => [],
            is_a($typeName, \Spatie\DataTransferObject\DataTransferObject::class, true) => $type->allowsNull()
                ? ['nullable', "exclude_if:{$name},null"]
                : ['required'],
            default => $type->allowsNull() ? ['nullable'] : ['required'],
        };
    }

    /**
     * @return array<string>
     */
    protected function rules(string $typeName): array
    {
        return match (true) {
            $typeName === 'int' => ['integer'],
            $typeName === 'string' => ['string'],
            $typeName === 'float' => ['numeric'],
            $typeName === 'bool' => ['boolean'],
            $typeName === 'array' => ['array'],
            is_a($typeName, DateTimeInterface::class, true) => ['string', 'date_format:Y-m-d H:i:s'],
            is_a($typeName, \Illuminate\Http\UploadedFile::class, true) => ['file'],
            class_exists(\Spatie\Enum\Laravel\Enum::class) && is_a($typeName, \Spatie\Enum\Laravel\Enum::class, true) => ['string', "\\{$typeName}::toRule()"],
            function_exists('enum_exists') && enum_exists($typeName) => ["new \\Illuminate\\Validation\\Rules\\Enum(\\{$typeName}::class)"],
            is_a($typeName, \Spatie\DataTransferObject\DataTransferObject::class, true) => ['array'],
            default => [],
        };
    }
}
