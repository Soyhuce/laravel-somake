<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class EventCommand extends Command
{
    use AsksDomain;

    /** @var string */
    public $signature = 'somake:event';

    /** @var string */
    public $description = 'Generates an Event in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $event = text(label: 'What is the Event name ?', required: true);

        $domain = $this->askDomain($finder->domains());

        $writer->write('event', ['event' => $event])
            ->toPath($finder->domainPath("{$domain}/Events/{$event}.php"));

        $eventFqcn = "Domain\\{$domain}\\Events\\{$event}";

        outro("The {$eventFqcn} class was successfully created !");
    }
}
