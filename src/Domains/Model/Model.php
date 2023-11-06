<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Model;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Soyhuce\Somake\Domains\DocBlock\DocBlock;
use Soyhuce\Somake\Domains\DocBlock\DocTag;
use function in_array;

class Model
{
    private readonly DocBlock $docBlock;

    /**
     * @param class-string<\Illuminate\Database\Eloquent\Model> $class
     */
    public function __construct(
        public string $class,
    ) {
        $this->docBlock = new DocBlock();
    }

    public function getName(): string
    {
        return class_basename($this->class);
    }

    public function getDomain(): string
    {
        return (string) Str::of($this->class)->after('Domain\\')->before('\\Models');
    }

    /**
     * @return \Illuminate\Support\Collection<int, \Soyhuce\Somake\Domains\Model\Attribute>
     */
    public function factoryAttributes(): Collection
    {
        return $this->docBlock
            ->getTags($this->class, ['@property'])
            ->map(fn (DocTag $docTag) => new Attribute(Str::after($docTag->name, '$'), $docTag->type))
            ->reject(fn (Attribute $attribute) => in_array(
                $attribute->name,
                ['id', 'created_at', 'updated_at', 'deleted_at']
            ));
    }

    /**
     * @return \Illuminate\Support\Collection<int, \Soyhuce\Somake\Domains\Model\Attribute>
     */
    public function allAttributes(): Collection
    {
        return $this->docBlock
            ->getTags($this->class, ['@property', '@property-read'])
            ->map(fn (DocTag $docTag) => new Attribute(Str::after($docTag->name, '$'), $docTag->type));
    }
}
