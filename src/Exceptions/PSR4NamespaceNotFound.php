<?php declare(strict_types=1);

namespace Soyhuce\Somake\Exceptions;

use Exception;

class PSR4NamespaceNotFound extends Exception
{
    public static function make(string $namespace): self
    {
        return new self("Cannot find namespace {$namespace} in composer PSR-4 autoloader");
    }
}
