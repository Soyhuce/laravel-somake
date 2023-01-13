<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

use Illuminate\Support\Str as IlluminateStr;

class Str extends IlluminateStr
{
    public static function removeExtraBlankLines(string $string): string
    {
        return preg_replace('/\n{3,}/', "\n\n", $string);
    }
}
