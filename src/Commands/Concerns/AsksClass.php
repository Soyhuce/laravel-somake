<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait AsksClass
{
    /**
     * @param Collection<int, string> $classes
     */
    protected function askClass(string $question, Collection $classes): string
    {
        if ($this->hasOption('class') && $this->option('class') !== null) {
            return $this->option('class');
        }

        if ($classes->isEmpty()) {
            return $this->ask("{$question} Please provide full qualified class name");
        }

        $class = $this->anticipate(
            $question,
            $classes->merge($classes->map(fn (string $class) => class_basename($class)))->sort()->all()
        );

        if ($classes->contains($class)) {
            return $class;
        }

        $guessedClasses = $classes->filter(
            fn (string $fqcn) => Str::lower(class_basename($fqcn)) === Str::lower($class)
        );

        return match ($guessedClasses->count()) {
            0 => $this->qualifyClass($question, $class),
            1 => $guessedClasses->first(),
            default => $this->disambiguateClass($guessedClasses)
        };
    }

    private function qualifyClass(string $question, string $class): string
    {
        if (class_exists($class)) {
            return $class;
        }
        $this->error("I did not found {$class} class.");

        return $this->ask("{$question} Please provide full qualified class name");
    }

    /**
     * @param \Illuminate\Support\Collection<int, string> $guessedClasses
     */
    private function disambiguateClass(Collection $guessedClasses): string
    {
        $this->info('I\'m not sure which class you choose...');

        return $this->choice('Which one should I choose ?', $guessedClasses->values()->all());
    }
}
