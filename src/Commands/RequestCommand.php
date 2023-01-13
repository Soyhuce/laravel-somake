<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Commands\Concerns\AsksData;
use Soyhuce\Somake\Commands\Concerns\AsksDTO;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Domains\Data\DataClass;
use Soyhuce\Somake\Domains\Data\DataProperty;
use Soyhuce\Somake\Domains\DTO\DTOClass;
use Soyhuce\Somake\Domains\DTO\DTOProperty;
use Soyhuce\Somake\Domains\Request\Ruler;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class RequestCommand extends Command
{
    use AsksApplication;
    use AsksDTO;
    use AsksData;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:request';

    /** @var string */
    public $description = 'Generates a Request in App';

    public function handle(Finder $finder, Writer $writer, Ruler $ruler): void
    {
        $request = $this->ask('What is the Request name ?');

        $application = $this->askApplication($finder->applications());
        $applicationNamespace = str_replace('/', '\\', $application);

        $namespace = $this->askOptionalNamespace($request, $finder->domains());

        if ($namespace === null) {
            $path = "{$application}/Requests/{$request}.php";
            $requestFqcn = "App\\{$applicationNamespace}\\Requests\\{$request}";
        } else {
            $path = "{$application}/Requests/{$namespace}/{$request}.php";
            $requestFqcn = "App\\{$applicationNamespace}\\Requests\\{$namespace}\\{$request}";
        }

        $fields = $this->resolveFields($finder, $ruler);

        $writer->write('request', ['request' => $request, 'fields' => $fields])
            ->withBaseClass(config('somake.base_classes.request'))
            ->toPath($finder->applicationPath($path));

        $this->info("The {$requestFqcn} class was successfully created !");

        $this->createUnitTest($requestFqcn);
    }

    /**
     * @return array<string, array<string>>
     */
    private function resolveFields(Finder $finder, Ruler $ruler): array
    {
        if (!$this->confirm('Do you want to fill the request with fields from a DTO/Data ?', true)) {
            return [];
        }

        if (InstalledVersions::isInstalled('spatie/data-transfer-object')) {
            $dto = $this->askDTO($finder->dtos());
            return DTOClass::from($dto)
                ->properties()
                ->flatMap(fn(DTOProperty $property) => $ruler->getRules($property))
                ->all();
        }

        if (InstalledVersions::isInstalled('spatie/laravel-data')) {
            $data = $this->askData($finder->datas());
            return DataClass::from($data)
                ->properties()
                ->flatMap(fn(DataProperty $property) => $ruler->getRules($property))
                ->all();
        }

        return [];
    }
}
