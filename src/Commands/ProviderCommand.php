<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Support\Writer;

class ProviderCommand extends Command
{
    /** @var string */
    public $signature = 'somake:provider';

    /** @var string */
    public $description = 'Generates a Service Provider';

    public function handle(Writer $writer): void
    {
        $provider = $this->ask('What is the ServiceProvider name ?');

        $providerFqcn = "Support\\Providers\\{$provider}";
        $writer->write('provider')->toClass($providerFqcn);

        $this->info("The {$providerFqcn} class was successfully created !");
    }
}
