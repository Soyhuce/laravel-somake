<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class EnumCommand extends Command
{
    use AsksDomain;

    /** @var string */
    public $signature = 'somake:enum';

    /** @var string */
    public $description = 'Generates an enum in Domain or Support';

    public function handle(Finder $finder, Writer $writer): void
    {
        $enum = $this->ask('What is the Enum name ?');

        if ($this->confirm('Do you want it to be in a Domain ? Say no if you want it in Support')) {
            $domain = $this->askDomain($finder->domains());
            $enumFqcn = "Domain\\{$domain}\\Enums\\{$enum}";
        } else {
            $enumFqcn = "Support\\Enums\\{$enum}";
        }

        $writer->write('enum')->toClass($enumFqcn);

        $this->info("The {$enumFqcn} enum was successfully created !");
    }
}
