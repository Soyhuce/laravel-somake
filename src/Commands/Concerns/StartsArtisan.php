<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Symfony\Component\Process\Process;

trait StartsArtisan
{
    public function startArtisanProcess(string $command): void
    {
        $process = Process::fromShellCommandline(
            command: "php artisan {$command} --ansi",
            input: STDIN
        );

        $process->start(function (string $type, string $message): void {
            echo $message;
        });

        while ($process->isRunning()) {
            usleep(1000);
        }
        $process->stop();

        // Reset blocking to STDIN
        stream_set_blocking(STDIN, true);
    }
}
