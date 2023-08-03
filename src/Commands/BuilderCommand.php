<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksModel;
use Soyhuce\Somake\Commands\Concerns\StartsArtisan;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\outro;

class BuilderCommand extends Command
{
    use AsksModel;
    use StartsArtisan;

    /** @var string */
    public $signature = 'somake:builder';

    /** @var string */
    public $description = 'Generates an Eloquent Builder';

    public function handle(Finder $finder, Writer $writer): void
    {
        $modelName = $this->askModel($finder->models());

        $builder = str_replace('\\Models\\', '\\Builders\\', $modelName) . 'Builder';

        $writer->write('builder')
            ->withBaseClass(config('somake.base_classes.builder'))
            ->toClass($builder);

        outro("The {$builder} class was successfully created !");

        if (!confirm("Do you want to add implementation of newEloquentBuilder in {$modelName} ?")) {
            return;
        }

        $writer->write('partials.model-new-eloquent-builder', ['builder' => $builder])
            ->inClass($modelName);

        $this->terminate();
    }

    private function terminate(): void
    {
        if (!InstalledVersions::isInstalled('soyhuce/next-ide-helper')) {
            return;
        }

        if (!confirm('Do you want to run next-ide-helper:models ?')) {
            return;
        }

        $this->startArtisanProcess('next-ide-helper:models');
    }
}
