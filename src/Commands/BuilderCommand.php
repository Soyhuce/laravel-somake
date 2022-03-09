<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksModel;
use Soyhuce\Somake\Commands\Concerns\StartsArtisan;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

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

        $writer->write('builder')->toClass($builder);

        $this->info("The {$builder} class was successfully created !");

        if (!$this->confirm("Do you want to add implementation of newEloquentBuilder in {$modelName} ?", true)) {
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

        if (!$this->confirm('Do you want to run next-ide-helper:models ?', true)) {
            return;
        }

        $this->startArtisanProcess('next-ide-helper:models');
    }
}
