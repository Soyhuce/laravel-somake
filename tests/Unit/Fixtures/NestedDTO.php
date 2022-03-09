<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Unit\Fixtures;

use Spatie\DataTransferObject\DataTransferObject;

class NestedDTO extends DataTransferObject
{
    public string $nestedString;

    public int $nestedInt;
}
