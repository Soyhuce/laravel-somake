<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

trait AsksClass
{
    /**
     * @param Collection<int, class-string> $classes
     * @return class-string
     */
    protected function askClass(string $question, Collection $classes): string
    {
        if ($this->hasOption('class') && $this->option('class') !== null) {
            return $this->option('class');
        }

        if ($classes->isEmpty()) {
            return text(
                label: $question,
                placeholder: 'Fully\\Qualified\\Class\\Name',
                required: true
            );
        }

        $class = suggest(
            label: $question,
            options: $classes->map(fn (string $class) => class_basename($class))
                ->sort()
                ->merge($classes->sort()),
            required: true
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

    /**
     * @return class-string
     */
    private function qualifyClass(string $question, string $class): string
    {
        if (class_exists($class)) {
            return $class;
        }
        warning("I did not found {$class} class.");

        return text(
            label: $question,
            placeholder: 'Fully\\Qualified\\Class\\Name',
            required: true
        );
    }

    /**
     * @param \Illuminate\Support\Collection<int, class-string> $guessedClasses
     */
    private function disambiguateClass(Collection $guessedClasses): string
    {
        warning('I\'m not sure which class you choose...');

        return select(
            label: 'Which one should I choose ?',
            options: $guessedClasses
        );
    }
}
