<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

use Soyhuce\Somake\Domains\Request\RouteGuesser;

class ContractTestGenerator
{
    public function __construct(
        public readonly string $controller,
        public readonly string $method,
    ) {
    }

    public function generate(): TestFile
    {
        $routeGuesser = new RouteGuesser($this->controller, $this->method);

        return TestFile::new()
            ->covers("{$this->controller}::{$this->method}")
            ->addTest(new TestFunction(
                'respects success contract',
                <<<PHP
                function (): void {
                    \$this->{$routeGuesser->verb()}Json("{$routeGuesser->url()}")
                        ->assertValidContract(200);
                }
                PHP
            ));
    }
}
