<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use RuntimeException;
use Soyhuce\Somake\Commands\Concerns\AsksClass;
use Soyhuce\Somake\Commands\Concerns\AsksMethod;
use Soyhuce\Somake\Domains\Test\ContractTestGenerator;
use Soyhuce\Somake\Domains\Test\FeatureTestGenerator;
use Soyhuce\Somake\Domains\Test\TestNameGuesser;
use Soyhuce\Somake\Domains\Test\UnitTestGenerator;
use Soyhuce\Somake\Support\Finder;
use Soyhuce\Somake\Support\Writer;
use function in_array;

class TestCommand extends Command
{
    use AsksClass;
    use AsksMethod;

    /** @var string */
    public $signature = 'somake:test {--type=} {--class=}';

    /** @var string */
    public $description = 'Generates a test class';

    public function handle(Finder $finder, Writer $writer): void
    {
        $type = $this->askType();

        $testFqcn = match ($type) {
            'Contract' => $this->handleContract($finder, $writer),
            'Feature' => $this->handleFeature($finder, $writer),
            'Unit' => $this->handleUnit($finder, $writer),
            default => throw new RuntimeException('Unknown test type : ' . $type),
        };

        $this->info("The {$testFqcn} class was successfully created !");
    }

    private function handleContract(Finder $finder, Writer $writer): string
    {
        $controller = $this->askClass('Which controller do you want to cover ?', $finder->controllers());
        $method = $this->askMethod('Which method do you want to cover ?', $controller);
        $testName = $this->ask('What is the Test name ?', (new TestNameGuesser())->guess($controller, $method));

        $testClass = sprintf(
            'Tests\\Contract\\%s\\%s',
            Str::of($controller)->after('App\\')->replace('\\Controllers\\', '\\')->replaceLast('Controller', ''),
            $testName
        );

        $testGenerator = new ContractTestGenerator($controller, $method);

        $writer->write($testGenerator->view(), $testGenerator->data())
            ->toClass($testClass);

        return $testClass;
    }

    private function handleFeature(Finder $finder, Writer $writer): string
    {
        $controller = $this->askClass('Which controller do you want to cover ?', $finder->controllers());
        $method = $this->askMethod('Which method do you want to cover ?', $controller);
        $testName = $this->ask('What is the Test name ?', (new TestNameGuesser())->guess($controller, $method));

        $testClass = sprintf(
            'Tests\\Feature\\%s\\%s',
            Str::of($controller)->after('App\\')->replace('\\Controllers\\', '\\'),
            $testName
        );

        $testGenerator = new FeatureTestGenerator($controller, $method);

        $writer->write($testGenerator->view(), $testGenerator->data())
            ->toClass($testClass);

        return $testClass;
    }

    private function handleUnit(Finder $finder, Writer $writer): string
    {
        $class = $this->askClass('Which class do you want to cover ?', $finder->classes());

        $testClass = "Tests\\Unit\\{$class}Test";

        $testGenerator = new UnitTestGenerator($class);

        $writer->write($testGenerator->view(), $testGenerator->data())
            ->toClass($testClass);

        return $testClass;
    }

    protected function askType(): string
    {
        $types = ['Contract', 'Feature', 'Unit'];

        if (in_array($this->option('type'), $types)) {
            return $this->option('type');
        }

        return $this->choice('Which kind of test do you want to create ?', $types);
    }
}
