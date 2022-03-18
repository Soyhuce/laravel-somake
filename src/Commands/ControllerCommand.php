<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class ControllerCommand extends Command
{
    use AsksApplication;

    /** @var string */
    public $signature = 'somake:controller';

    /** @var string */
    public $description = 'Generates a Controller in App';

    public function handle(Finder $finder, Writer $writer): void
    {
        $controller = $this->ask('What is the Controller name ?');

        $application = $this->askApplication($finder->applications());
        $applicationNamespace = str_replace('/', '\\', $application);

        $namespace = $this->askOptionalNamespace($controller, $finder->domains());

        if ($namespace === null) {
            $path = "{$application}/Controllers/{$controller}.php";
            $controllerFqcn = "App\\{$applicationNamespace}\\Controllers\\{$controller}";
        } else {
            $path = "{$application}/Controllers/{$namespace}/{$controller}.php";
            $controllerFqcn = "App\\{$applicationNamespace}\\Controllers\\{$namespace}\\{$controller}";
        }

        $writer->write('controller', ['controller' => $controller])
            ->withBaseClass(config('somake.base_classes.controller'))
            ->toPath($finder->applicationPath($path));

        $this->info("The {$controllerFqcn} class was successfully created !");
    }
}
