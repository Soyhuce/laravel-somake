<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Auth\Access\Gate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Gate as GateFacade;
use ReflectionClass;
use Soyhuce\Somake\Commands\Concerns\AsksModel;
use Soyhuce\Somake\Commands\Concerns\StartsArtisan;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;

class PolicyCommand extends Command
{
    use AsksModel;
    use StartsArtisan;

    /** @var string */
    public $signature = 'somake:policy';

    /** @var string */
    public $description = 'Generates a Model Policy';

    public function handle(Finder $finder, Writer $writer): void
    {
        $modelName = $this->askModel($finder->models());

        $policy = $this->guessPolicyName($modelName);

        $writer->write('policy')
            ->withBaseClass(config('somake.base_classes.policy'))
            ->toClass($policy);

        $this->info("The {$policy} class was successfully created !");

        $this->terminate($policy);
    }

    protected function guessPolicyName(string $modelName): string
    {
        $gateClass = new ReflectionClass(Gate::class);
        $guessPolicyName = $gateClass->getMethod('guessPolicyName');
        $guessPolicyName->setAccessible(true);

        return $guessPolicyName->invoke(GateFacade::getFacadeRoot(), $modelName)[0];
    }

    private function terminate(string $policyFqcn): void
    {
        if (!$this->confirm("Do you want to create a Unit Test for {$policyFqcn} ?", true)) {
            return;
        }

        $this->startArtisanProcess('somake:test --type=Unit --class=' . str_replace('\\', '\\\\', $policyFqcn));
    }
}
