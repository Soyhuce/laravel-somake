<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Unit\Domain\Request;

use Soyhuce\Somake\Domains\DTO\DTOClass;
use Soyhuce\Somake\Domains\DTO\DTOProperty;
use Soyhuce\Somake\Domains\Request\Ruler;
use Soyhuce\Somake\Tests\TestCase;
use Soyhuce\Somake\Tests\Unit\Fixtures\TestDTO;

/**
 * @covers \Soyhuce\Somake\Domains\Request\Ruler
 */
class RulerTest extends TestCase
{
    /**
     * @test
     */
    public function rulesAreCorrectlyResolved(): void
    {
        $ruler = new Ruler();

        $rules = DTOClass::from(TestDTO::class)
            ->properties()
            ->flatMap(fn (DTOProperty $property) => $ruler->getRules($property))
            ->all();

        $this->assertEquals(
            [
                'int' => ['required', 'integer'],
                'string' => ['required', 'string'],
                'float' => ['required', 'numeric'],
                'array' => ['array'],
                'bool' => ['required', 'boolean'],
                'nullableString' => ['nullable', 'string'],
                'intOrString' => [],
                'noType' => [],
                'unknwonType' => ['required'],
                'carbon' => ['required', 'string', 'date_format:Y-m-d H:i:s'],
                'dateTime' => ['required', 'string', 'date_format:Y-m-d H:i:s'],
                'file' => ['required', 'file'],
                'enum' => ['required', 'new \\Illuminate\Validation\Rules\Enum(\Soyhuce\Somake\Tests\Unit\Fixtures\MyEnum::class)'],
                'dto' => ['required', 'array'],
                'dto.nestedString' => ['required', 'string'],
                'dto.nestedInt' => ['required', 'integer'],
                'nullableDto' => ['nullable', 'exclude_if:nullableDto,null', 'array'],
                'nullableDto.nestedString' => ['required', 'string'],
                'nullableDto.nestedInt' => ['required', 'integer'],
            ],
            $rules
        );
    }
}
