<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait AsksDomain
{
    use WrapsCallable;

    /**
     * @param \Illuminate\Support\Collection<int, string> $domains
     */
    protected function askDomain(Collection $domains): string
    {
        if ($domains->isEmpty()) {
            return $this->ask('What is the Domain ?');
        }

        $this->showDomains($domains);

        return $this->anticipate('What is the Domain ?', $this->wrapCallable($domains->all()));
    }

    /**
     * @param \Illuminate\Support\Collection<int, string> $domains
     */
    protected function showDomains(Collection $domains): void
    {
        $this->info(sprintf('I detected %d %s.', $domains->count(), Str::plural('domain', $domains->count())));

        $table = $domains->map(fn (string $domain) => [$domain]);
        $this->table(['Domain'], $table);
    }
}
