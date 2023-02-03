<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

use Soyhuce\Somake\Domains\Request\RouteGuesser;

class FeatureTestGenerator
{
    public function __construct(
        public string $controller,
        public string $method,
    ) {
    }

    public function view(): string
    {
        return 'test-feature';
    }

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        $routeGuesser = new RouteGuesser($this->controller, $this->method);

        return [
            'covered' => "{$this->controller}::{$this->method}",
            'url' => $routeGuesser->url(),
            'verb' => $routeGuesser->verb(),
        ];
    }
}
