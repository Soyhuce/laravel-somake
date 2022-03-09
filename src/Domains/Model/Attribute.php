<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Model;

class Attribute
{
    public function __construct(
        public string $name,
        public string $type,
    ) {
    }
}
