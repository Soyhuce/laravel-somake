<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use Symfony\Component\Console\Attribute\AsCommand;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

#[AsCommand(name: 'somake:data', description: 'Generates a Data in Domain')]
class DataCommand extends Command
{
    use AsksDomain;

    /** @var string */
    public $signature = 'somake:data';

    /** @var string */
    public $description = 'Generates a Data in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $data = text(label: 'What is the Data name ?', required: true);

        $domain = $this->askDomain($finder->domains());

        $writer->write('data', ['data' => $data])
            ->withBaseClass(config('somake.base_classes.data'))
            ->toPath($finder->domainPath("{$domain}/Data/{$data}.php"));

        $dataFqcn = "Domain\\{$domain}\\Data\\{$data}";

        outro("The {$dataFqcn} class was successfully created !");
    }
}
