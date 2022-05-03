<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Request;

use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Str;

class RouteGuesser
{
    private ?Route $route;

    public function __construct(string $controller, string $method)
    {
        $this->route = RouteFacade::getRoutes()->getByAction("{$controller}@{$method}");
    }

    public function verb(): string
    {
        $verb = $this->route?->methods()[0] ?? 'get';

        return Str::lower($verb);
    }

    public function url(): string
    {
        if ($this->route === null) {
            return '/';
        }

        $parameters = Collection::make($this->route->parameterNames());

        return Str::replace(
            $parameters->map(fn (string $parameter) => "{{$parameter}}")->all(),
            $parameters->map(fn (string $parameter) => "{\${$parameter}}")->all(),
            $this->route->uri()
        );
    }
}
