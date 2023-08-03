<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Factories\Factory;
use Soyhuce\Somake\Commands\Concerns\AsksModel;
use Soyhuce\Somake\Commands\Concerns\StartsArtisan;
use Soyhuce\Somake\Domains\Model\Model;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\outro;

class FactoryCommand extends Command
{
    use AsksModel;
    use StartsArtisan;

    /** @var string */
    public $signature = 'somake:factory {--model=}';

    /** @var string */
    public $description = 'Generates a Model Factory';

    public function handle(Finder $finder, Writer $writer): void
    {
        $modelName = $this->askModel($finder->models());

        $factory = Factory::resolveFactoryName($modelName);

        $model = new Model($modelName);

        $writer->write('factory', ['model' => $model])
            ->withBaseClass(config('somake.base_classes.factory'))
            ->toClass($factory);

        outro("The {$factory} class was successfully created !");

        $this->terminate();
    }

    private function terminate(): void
    {
        if (!InstalledVersions::isInstalled('soyhuce/next-ide-helper')) {
            return;
        }

        if (!confirm('Do you want to run next-ide-helper:factories ?')) {
            return;
        }

        $this->startArtisanProcess('next-ide-helper:factories');
    }
}
