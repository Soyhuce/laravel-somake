<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\DocBlock;

class DocTag
{
    public function __construct(
        public ?string $name,
        public string $type,
    ) {
    }
}
