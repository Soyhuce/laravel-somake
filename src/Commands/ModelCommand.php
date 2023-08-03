<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksDomain;
use Soyhuce\Somake\Commands\Concerns\StartsArtisan;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\text;

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
        $model = text(label: 'What is the Model name ?', required: true);

        $domain = $this->askDomain($finder->domains());

        $writer->write('model', ['model' => $model])
            ->withBaseClass(config('somake.base_classes.model'))
            ->toPath($finder->domainPath("{$domain}/Models/{$model}.php"));

        $modelFqcn = "Domain\\{$domain}\\Models\\{$model}";
        outro("The {$modelFqcn} class was successfully created !");

        $this->terminate($modelFqcn);
    }

    private function terminate(string $model): void
    {
        if (
            InstalledVersions::isInstalled('soyhuce/next-ide-helper')
            && confirm('Do you want to run next-ide-helper:models ?')
        ) {
            $this->startArtisanProcess('next-ide-helper:models');
        }

        if (!confirm('Do you want to create the model factory ?')) {
            return;
        }

        $this->startArtisanProcess('somake:factory --model ' . str_replace('\\', '\\\\', $model));
    }
}
