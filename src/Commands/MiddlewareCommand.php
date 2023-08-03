<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

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
        $middleware = text(label: 'What is the Middleware name ?', required: true);

        $middlewareFqcn = select(
            label: 'Where do you want it to be created ?',
            options: ['Application', 'Support'],
            default: 'Application'
        ) === 'Application'
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

        if ($namespace === '') {
            return "App\\{$applicationNamespace}\\Middleware\\{$middleware}";
        }

        return "App\\{$applicationNamespace}\\Middleware\\{$namespace}\\{$middleware}";
    }

    private function inSupport(string $middleware): string
    {
        $namespace = $this->askOptionalNamespace($middleware);

        if ($namespace === '') {
            return "Support\\Http\\Middleware\\{$middleware}";
        }

        return "Support\\Http\\Middleware\\{$namespace}\\{$middleware}";
    }
}
