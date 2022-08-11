<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class MiddlewareCommand extends Command
{
    use AsksApplication;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:middleware';

    /** @var string */
    public $description = 'Generates a Middleware in App';

    public function handle(Finder $finder, Writer $writer): void
    {
        $middleware = $this->ask('What is the Middleware name ?');

        $middlewareFqcn = $this->confirm('Do you want it to be in an Application ? Say no if you want it in Support', true)
            ? $this->inApplication($finder, $middleware)
            : $this->inSupport($middleware);

        $writer->write('middleware')->toClass($middlewareFqcn);

        $this->info("The {$middlewareFqcn} class was successfully created !");

        $this->createUnitTest($middlewareFqcn);
    }

    private function inApplication(Finder $finder, string $middleware): string
    {
        $application = $this->askApplication($finder->applications());
        $applicationNamespace = str_replace('/', '\\', $application);

        $namespace = $this->askOptionalNamespace($middleware, $finder->domains());

        if ($namespace === null) {
            return "App\\{$applicationNamespace}\\Middleware\\{$middleware}";
        }

        return "App\\{$applicationNamespace}\\Middleware\\{$namespace}\\{$middleware}";
    }

    private function inSupport(string $middleware): string
    {
        $namespace = $this->askOptionalNamespace($middleware);

        if ($namespace === null) {
            return "Support\\Http\\Middleware\\{$middleware}";
        }

        return "Support\\Http\\Middleware\\{$namespace}\\{$middleware}";
    }
}
