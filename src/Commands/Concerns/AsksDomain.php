<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use function Laravel\Prompts\suggest;

trait AsksDomain
{
    use WrapsSuggestions;

    /**
     * @param \Illuminate\Support\Collection<int, string> $domains
     */
    protected function askDomain(Collection $domains): string
    {
        return suggest(
            label: 'What is the Domain ?',
            options: $this->wrapSuggestions($domains),
            required: true
        );
    }
}
