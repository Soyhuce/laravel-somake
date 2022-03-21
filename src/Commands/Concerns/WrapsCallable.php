<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Closure;
use function is_callable;

trait WrapsCallable
{
    /**
     * @template TKey of array-key
     * @template TValue
     * @param array<TKey, TValue> $array
     * @return array<TKey, TValue>|Closure(): array<TKey, TValue> $defaults
     */
    public function wrapCallable(array $array): array|Closure
    {
        if (!is_callable($array)) {
            return $array;
        }

        return fn () => $array;
    }
}
