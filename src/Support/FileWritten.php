<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

class FileWritten
{
    public function __construct(
        public string $path,
    ) {
    }
}
