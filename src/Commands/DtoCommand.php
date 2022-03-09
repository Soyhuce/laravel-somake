<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class DtoCommand extends Command
{
    use AsksDomain;

    /** @var string */
    public $signature = 'somake:dto';

    /** @var string */
    public $description = 'Generates a DTO in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $dto = $this->ask('What is the DTO name ?');

        $domain = $this->askDomain($finder->domains());

        $writer->write('dto', ['dto' => $dto])->toPath($finder->domainPath("{$domain}/DTO/{$dto}.php"));

        $dtoFqcn = "Domain\\{$domain}\\DTO\\{$dto}";
        $this->info("The {$dtoFqcn} class was successfully created !");
    }
}
