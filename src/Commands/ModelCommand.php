<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Commands\Concerns\StartsArtisan;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class ModelCommand extends Command
{
    use AsksDomain;
    use StartsArtisan;

    /** @var string */
    public $signature = 'somake:model';

    /** @var string */
    public $description = 'Generates a Model in Domain';

    public function handle(Finder $finder, Writer $writer): void
    {
        $model = $this->ask('What is the Model name ?');

        $domain = $this->askDomain($finder->domains());

        $writer->write('model', ['model' => $model])->toPath($finder->domainPath("{$domain}/Models/{$model}.php"));

        $modelFqcn = "Domain\\{$domain}\\Models\\{$model}";
        $this->info("The {$modelFqcn} class was successfully created !");

        $this->terminate($modelFqcn);
    }

    private function terminate(string $model): void
    {
        if (
            InstalledVersions::isInstalled('soyhuce/next-ide-helper')
            && $this->confirm('Do you want to run next-ide-helper:models ?', true)
        ) {
            $this->startArtisanProcess('next-ide-helper:models');
        }

        if (!$this->confirm('Do you want to create the model factory ?', true)) {
            return;
        }

        $this->startArtisanProcess('somake:factory --model ' . str_replace('\\', '\\\\', $model));
    }
}
