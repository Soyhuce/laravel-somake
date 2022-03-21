<?php declare(strict_types=1);

namespace Soyhuce\Somake\Support;

use Illuminate\Support\Collection;
use Spatie\Fork\Fork;
use Symfony\Component\Process\Process;

class FileOpener
{
    /** @var Collection<int, \Soyhuce\Somake\Support\FileWritten> */
    protected Collection $events;

    public function __construct()
    {
        $this->events = new Collection();
    }

    public function handle(FileWritten $event): void
    {
        $this->events->push($event);
    }

    public function openFiles(): void
    {
        if ($this->events->isEmpty()) {
            return;
        }

        $ide = env('IDE');
        if ($ide === null) {
            return;
        }

        Fork::new()->run(
            ...$this->events
                ->map(fn (FileWritten $event): callable => $this->openFileClosure($ide, $event->path))
                ->all()
        );
    }

    protected function openFileClosure(string $ide, string $path): callable
    {
        return function () use ($ide, $path): void {
            Process::fromShellCommandline(command: "{$ide} {$path}")->run();
        };
    }
}
