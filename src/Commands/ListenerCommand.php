<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Commands\Concerns\AsksEvent;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class ListenerCommand extends Command
{
    use AsksDomain;
    use AsksEvent;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:listener';

    /** @var string */
    public $description = 'Generates a Listener in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $listener = text(label: 'What is the Listener name ?', required: true);

        $event = $this->askEvent(
            'Which event should the listener listen to ?',
            $finder->events()
        );

        $queued = $this->confirm(question: 'Should the listener be queued ?', default: true);

        $domain = $this->askDomain($finder->domains());

        $writer
            ->write(
                'listener',
                [
                    'listener' => $listener,
                    'queued' => $queued,
                    'eventFqcn' => $event,
                    'event' => class_basename($event),
                ]
            )
            ->toPath($finder->domainPath("{$domain}/Listeners/{$listener}.php"));

        $listenerFqcn = "Domain\\{$domain}\\Listeners\\{$listener}";

        outro("The {$listenerFqcn} class was successfully created !");

        $this->createUnitTest($listenerFqcn);
    }
}
