<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Unit\Fixtures;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class TestDTO extends DataTransferObject
{
    public int $int;

    public string $string;

    public float $float;

    public bool $bool;

    public array $array;

    public ?string $nullableString;

    public $noType;

    public int|string $intOrString;

    public Model $unknwonType;

    public Carbon $carbon;

    public DateTimeInterface $dateTime;

    public UploadedFile $file;

    public MyEnum $enum;

    public NestedDTO $dto;

    public ?NestedDTO $nullableDto;
}
