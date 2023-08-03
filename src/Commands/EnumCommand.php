<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class EnumCommand extends Command
{
    use AsksDomain;

    /** @var string */
    public $signature = 'somake:enum';

    /** @var string */
    public $description = 'Generates an enum in Domain or Support';

    public function handle(Finder $finder, Writer $writer): void
    {
        $enum = text(
            label: 'What is the Enum name ?',
            required: true
        );

        if (
            select(
                label: 'Where do you want it to be created ?',
                options: ['Domain', 'Support'],
                default: 'Domain'
            ) === 'Domain'
        ) {
            $domain = $this->askDomain($finder->domains());
            $enumFqcn = "Domain\\{$domain}\\Enums\\{$enum}";
        } else {
            $enumFqcn = "Support\\Enums\\{$enum}";
        }

        $writer->write('enum')->toClass($enumFqcn);

        outro("The {$enumFqcn} enum was successfully created !");
    }
}
