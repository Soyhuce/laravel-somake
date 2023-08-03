<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class ActionCommand extends Command
{
    use AsksDomain;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:action';

    /** @var string */
    public $description = 'Generates an Action in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $action = text(label: 'What is the Action name ?', required: true);

        $domain = $this->askDomain($finder->domains());

        $writer->write('action', ['action' => $action])
            ->withBaseClass(config('somake.base_classes.action'))
            ->toPath($finder->domainPath("{$domain}/Actions/{$action}.php"));

        $actionFqcn = "Domain\\{$domain}\\Actions\\{$action}";
        outro("The {$actionFqcn} class was successfully created !");

        $this->createUnitTest($actionFqcn);
    }
}
