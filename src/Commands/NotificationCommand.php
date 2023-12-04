<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class NotificationCommand extends Command
{
    use AsksDomain;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:notification';

    /** @var string */
    public $description = 'Generates a Notification in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $notification = text(label: 'What is the Notification name ?', required: true);

        $queued = $this->confirm(question: 'Should the notification be queued ?');

        $domain = $this->askDomain($finder->domains());

        $writer
            ->write(
                'notification',
                [
                    'notification' => $notification,
                    'queued' => $queued,
                ]
            )
            ->toPath($finder->domainPath("{$domain}/Notifications/{$notification}.php"));

        $notificationFqcn = "Domain\\{$domain}\\Notifications\\{$notification}";

        outro("The {$notificationFqcn} class was successfully created !");

        $this->createUnitTest($notificationFqcn);
    }
}
