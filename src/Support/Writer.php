<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

class Writer
{
    protected Composer $composer;

    public function __construct(Composer $composer)
    {
        $this->composer = $composer;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function write(string $stub, array $data = []): PendingWriter
    {
        return new PendingWriter($this->composer, $stub, $data);
    }
}
