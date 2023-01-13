<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Soyhuce\Somake\Contracts\UnitTestGenerator;
use Soyhuce\Somake\Domains\Test\TestFile;
use Soyhuce\Somake\Domains\Test\TestFunction;

/**
 * @implements UnitTestGenerator<\Illuminate\Foundation\Http\FormRequest>
 */
class FormRequestTestGenerator implements UnitTestGenerator
{
    /**
     * @param class-string $class
     */
    public static function shouldHandle(string $class): bool
    {
        return is_subclass_of($class, FormRequest::class);
    }

    public function generate(string $class): TestFile
    {
        return TestFile::new()
            ->covers($class)
            ->uses($class)
            ->addTest($this->validationTest($class));
    }

    /**
     * @param class-string<FormRequest> $class
     */
    private function validationTest(string $class): TestFunction
    {
        $classBasename = class_basename($class);

        $parameters = Collection::make(app()->call([new $class(), 'rules']))
            ->map(fn ($value, $key) => str_repeat(' ', 12) . "'{$key}' => null,")
            ->implode(PHP_EOL);

        return new TestFunction(
            'passes validation',
            <<<PHP
            function (): void {
                \$this->createRequest({$classBasename}::class)
                    ->validate([
            {$parameters}            
                    ])
                    ->assertPasses();
            }
            PHP
        );
    }
}
