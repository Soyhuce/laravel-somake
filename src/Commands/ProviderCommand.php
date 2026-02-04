<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Support\Writer;
use Symfony\Component\Console\Attribute\AsCommand;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

#[AsCommand(name: 'somake:provider', description: 'Generates a Service Provider')]
class ProviderCommand extends Command
{
    /** @var string */
    public $signature = 'somake:provider';

    /** @var string */
    public $description = 'Generates a Service Provider';

    public function handle(Writer $writer): void
    {
        $provider = text(label: 'What is the ServiceProvider name ?', required: true);

        $providerFqcn = "Support\\Providers\\{$provider}";
        $writer->write('provider')->toClass($providerFqcn);

        outro("The {$providerFqcn} class was successfully created !");
    }
}
