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

        $application = $this->askApplication($finder->applications());
        $applicationNamespace = str_replace('/', '\\', $application);

        $namespace = $this->askOptionalNamespace($middleware, $finder->domains());

        if ($namespace === null) {
            $path = "{$application}/Middlewares/{$middleware}.php";
            $middlewareFqcn = "App\\{$applicationNamespace}\\Middlewares\\{$middleware}";
        } else {
            $path = "{$application}/Middlewares/{$namespace}/{$middleware}.php";
            $middlewareFqcn = "App\\{$applicationNamespace}\\Middlewares\\{$namespace}\\{$middleware}";
        }

        $writer->write('middleware', ['middleware' => $middleware])->toPath($finder->applicationPath($path));

        $this->info("The {$middlewareFqcn} class was successfully created !");

        $this->createUnitTest($middlewareFqcn);
    }
}
