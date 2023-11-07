<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

class Writer
{
    public function __construct(
        protected Composer $composer,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function write(string $stub, array $data = []): PendingWriter
    {
        return new PendingWriter($this->composer, $stub, $data);
    }
}
