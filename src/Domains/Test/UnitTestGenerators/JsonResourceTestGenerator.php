<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Soyhuce\Somake\Contracts\UnitTestGenerator;
use Soyhuce\Somake\Domains\DocBlock\DocBlock;
use Soyhuce\Somake\Support\UniversalObject;
use Throwable;

/**
 * @implements \Soyhuce\Somake\Contracts\UnitTestGenerator<\Illuminate\Http\Resources\Json\JsonResource>
 */
class JsonResourceTestGenerator implements UnitTestGenerator
{
    private DocBlock $docBlock;

    public function __construct()
    {
        $this->docBlock = new DocBlock();
    }

    public static function shouldHandle(string $class): bool
    {
        return is_subclass_of($class, JsonResource::class);
    }

    public function view(): string
    {
        return 'test-unit-json-resource';
    }

    public function data(string $class): array
    {
        $modelMixin = $this->extractMixin($class);
        $fields = $this->extractFields($class);

        if ($modelMixin === null) {
            return [
                'model' => 'resource',
                'modelClassBasename' => null,
                'modelFqcn' => null,
                'fields' => $fields,
            ];
        }

        [$modelFqcn, $modelClassBasename] = class_exists($modelMixin)
            ? [mb_ltrim($modelMixin, '\\'), class_basename($modelMixin)]
            : [null, class_basename($modelMixin)];

        return [
            'modelFqcn' => $modelFqcn,
            'modelClassBasename' => $modelClassBasename,
            'model' => Str::camel($modelClassBasename),
            'fields' => $fields,
        ];
    }

    /**
     * @param class-string<JsonResource> $class
     */
    private function extractMixin(string $class): ?string
    {
        return $this->docBlock
            ->getTags($class, ['@mixin'])
            ->first()
            ?->type;
    }

    /**
     * @param class-string<JsonResource> $class
     * @return array<int, string>
     */
    private function extractFields(string $class): array
    {
        try {
            $resource = new $class(new UniversalObject());

            return array_keys($resource->resolve(new Request()));
        } catch (Throwable) {
            return [];
        }
    }
}
