<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait AsksApplication
{
    /**
     * @param \Illuminate\Support\Collection<int, string> $applications
     */
    protected function askApplication(Collection $applications): string
    {
        if ($applications->isEmpty()) {
            return $this->ask('What is the Application ?');
        }

        $this->showApplications($applications);

        return $this->anticipate('What is the Application ?', $applications->all());
    }

    /**
     * @param \Illuminate\Support\Collection<int, string> $applications
     */
    protected function showApplications(Collection $applications): void
    {
        $this->info(sprintf(
            'I detected %d %s.',
            $applications->count(),
            Str::plural('application', $applications->count())
        ));

        $table = $applications->map(fn (string $application) => [$application]);
        $this->table(['Applications'], $table);
    }

    /**
     * @param \Illuminate\Support\Collection<int, string>|null $domains
     */
    protected function askOptionalNamespace(string $classname, ?Collection $domains = null): ?string
    {
        return $this->anticipate(
            "You may want {$classname} to live in a sub namespace. Which one ?"
            . ' Leave it empty if you want to leave it in root namespace.',
            $domains?->all() ?? []
        );
    }
}
