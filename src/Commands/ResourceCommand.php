<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Commands\Concerns\AsksModel;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Domains\Model\Model;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

class ResourceCommand extends Command
{
    use AsksApplication;
    use AsksModel;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:resource';

    /** @var string */
    public $description = 'Generates a resource in App';

    public function handle(Finder $finder, Writer $writer): void
    {
        $resource = text(label: 'What is the Resource name ?', required: true);

        $application = $this->askApplication($finder->applications());
        $applicationNamespace = str_replace('/', '\\', $application);

        $modelName = $this->askModel($finder->models());
        $model = new Model($modelName);

        $path = "{$application}/Resources/{$model->getDomain()}/{$resource}.php";
        $resourceFqcn = "App\\{$applicationNamespace}\\Resources\\{$model->getDomain()}\\{$resource}";

        $writer->write('resource', ['resource' => $resource, 'model' => $model])
            ->withBaseClass(config('somake.base_classes.resource'))
            ->toPath($finder->applicationPath($path));

        outro("The {$resourceFqcn} class was successfully created !");
        $this->createUnitTest($resourceFqcn);
    }
}
