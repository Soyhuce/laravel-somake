<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait WrapsSuggestions
{
    /**
     * @param Collection<int, string> $suggestions
     * @return Closure(string): array<int, string>
     */
    public function wrapSuggestions(Collection $suggestions): Closure
    {
        return fn (string $value) => $suggestions
            ->when(
                $value !== '',
                fn (Collection $suggestions) => $suggestions->filter(
                    fn (string $suggestion) => Str::contains($suggestion, $value, ignoreCase: true)
                )
            )
            ->all();
    }
}
