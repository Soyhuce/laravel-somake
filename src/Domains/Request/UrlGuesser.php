<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Request;

use Illuminate\Routing\Exceptions\UrlGenerationException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;

class UrlGuesser
{
    public function __construct(
        private string $controller,
        private string $method,
    ) {
    }

    public function guess(): string
    {
        try {
            return action([$this->controller, $this->method], [], false);
        } catch (UrlGenerationException $exception) {
            return $this->guessWithParameters($exception);
        } catch (InvalidArgumentException) {
            return '/';
        }
    }

    private function guessWithParameters(UrlGenerationException $exception): string
    {
        $parameters = $this->extractParameters($exception->getMessage());

        $placeholders = $parameters->mapWithKeys(fn (string $parameter) => [$parameter => Str::random()]);

        $url = action([$this->controller, $this->method], $placeholders->toArray(), false);

        return Str::of($url)
            ->replace(
                $placeholders->values()->all(),
                $placeholders->keys()->map(fn (string $parameter) => sprintf('{$%s}', $parameter))->all()
            )
            ->toString();
    }

    /**
     * @return \Illuminate\Support\Collection<int, string>
     */
    private function extractParameters(string $message): Collection
    {
        return Str::of($message)
            ->match('#\[Missing parameters?: (?<parameters>.*)\].#')
            ->explode(', ');
    }
}
