<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Enum;
use Soyhuce\Somake\Commands\Concerns\AsksApplication;
use Soyhuce\Somake\Commands\Concerns\AsksData;
use Soyhuce\Somake\Commands\Concerns\CreatesAssociatedUnitTest;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use Spatie\LaravelData\Resolvers\DataValidationRulesResolver;
use Spatie\LaravelData\Support\Validation\DataRules;
use Spatie\LaravelData\Support\Validation\ValidationPath;
use function is_string;

class RequestCommand extends Command
{
    use AsksApplication;
    use AsksData;
    use CreatesAssociatedUnitTest;

    /** @var string */
    public $signature = 'somake:request';

    /** @var string */
    public $description = 'Generates a Request in App';

    public function handle(Finder $finder, Writer $writer): void
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

        $fields = $this->resolveFields($finder);

        $writer->write('request', ['request' => $request, 'fields' => $fields])
            ->withBaseClass(config('somake.base_classes.request'))
            ->toPath($finder->applicationPath($path));

        $this->info("The {$requestFqcn} class was successfully created !");

        $this->createUnitTest($requestFqcn);
    }

    /**
     * @return array<string, array<string>>
     */
    private function resolveFields(Finder $finder): array
    {
        if (!InstalledVersions::isInstalled('spatie/laravel-data')) {
            return [];
        }

        if (!$this->confirm('Do you want to fill the request with fields from a Data ?', true)) {
            return [];
        }

        $data = $this->askData($finder->datas());

        $fields = app(DataValidationRulesResolver::class)->execute(
            $data,
            [],
            ValidationPath::create(),
            DataRules::create()
        );

        foreach ($fields as &$rules) {
            $rules = $this->formatRules($rules);
        }

        return $fields;
    }

    /**
     * @param array<int, mixed> $rules
     * @return array<int, string>
     */
    private function formatRules(mixed $rules): array
    {
        return Collection::make($rules)
            ->map($this->formatRule(...))
            ->filter()
            ->values()
            ->all();
    }

    private function formatRule(mixed $rule): ?string
    {
        if (is_string($rule)) {
            return "'{$rule}'";
        }

        if ($rule instanceof Enum) {
            $type = (fn () => $this->type)->call($rule);

            return "\\Illuminate\\Validation\\Rule::enum(\\{$type}::class)";
        }

        $this->error("I wasn't able to format a rule of type " . $rule::class . '. Please report this issue to github.com/Soyhuce/laravel-somake.');

        return null;
    }
}
