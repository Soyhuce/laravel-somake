<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class ControllerCommand extends Command
{
    use AsksApplication;

    /** @var string */
    public $signature = 'somake:controller';

    /** @var string */
    public $description = 'Generates a Controller in App';

    public function handle(Finder $finder, Writer $writer): void
    {
        $controller = text(label: 'What is the Controller name ?', required: true);

        $application = $this->askApplication($finder->applications());
        $applicationNamespace = str_replace('/', '\\', $application);

        $namespace = $this->askOptionalNamespace($controller, $finder->domains());

        if ($namespace === '') {
            $path = "{$application}/Controllers/{$controller}.php";
            $controllerFqcn = "App\\{$applicationNamespace}\\Controllers\\{$controller}";
        } else {
            $path = "{$application}/Controllers/{$namespace}/{$controller}.php";
            $controllerFqcn = "App\\{$applicationNamespace}\\Controllers\\{$namespace}\\{$controller}";
        }

        $writer->write('controller', ['controller' => $controller])
            ->withBaseClass(config('somake.base_classes.controller'))
            ->toPath($finder->applicationPath($path));

        outro("The {$controllerFqcn} class was successfully created !");
    }
}
