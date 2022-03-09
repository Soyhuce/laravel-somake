<?php declare(strict_types=1);

namespace Soyhuce\Somake\Exceptions;

use Exception;

class PSR4PathNotFound extends Exception
{
    public static function make(string $path): self
    {
        return new self("Cannot find path {$path} in composer PSR-4 autoloader");
    }
}
