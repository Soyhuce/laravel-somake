<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class CommandCommand extends Command
{
    use CreatesAssociatedUnitTest;

    /** @var string */
    protected $signature = 'somake:command';

    /** @var string */
    protected $description = 'Generates a Command in App\Commands';

    public function handle(Writer $writer): void
    {
        $command = text(label: 'What is the Command name ?', required: true);
        $commandFqcn = 'App\\Commands\\' . $command;

        $writer->write('command')
            ->withBaseClass(config('somake.base_classes.command'))
            ->toClass($commandFqcn);

        outro("The {$commandFqcn} class was successfully created !");

        $this->createUnitTest($commandFqcn);
    }
}
