<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

trait AsksEvent
{
    use WrapsSuggestions;

    /**
     * @param Collection<int, class-string> $events
     * @return ''|class-string
     */
    protected function askEvent(string $question, Collection $events): string
    {
        if ($events->isEmpty()) {
            return text(
                label: $question,
                placeholder: 'Fully\\Qualified\\Class\\Name'
            );
        }

        $event = suggest(
            label: $question,
            options: $this->wrapSuggestions(
                $events->map(fn (string $event) => class_basename($event))
                    ->sort()
                    ->merge($events->sort())
            ),
        );

        if ($event === '') {
            return '';
        }

        if ($events->contains($event)) {
            return $event;
        }

        $guessedEvents = $events->filter(
            fn (string $fqcn) => Str::lower(class_basename($fqcn)) === Str::lower($event)
        );

        return match ($guessedEvents->count()) {
            0 => $this->qualifyEvent($question, $event),
            1 => $guessedEvents->first(),
            default => $this->disambiguateEvent($guessedEvents)
        };
    }

    /**
     * @return class-string
     */
    private function qualifyEvent(string $question, string $event): string
    {
        if (class_exists($event)) {
            return $event;
        }
        warning("I did not found {$event} class.");

        return text(
            label: $question,
            placeholder: 'Fully\\Qualified\\Class\\Name'
        );
    }

    /**
     * @param \Illuminate\Support\Collection<int, class-string> $guessedEvents
     */
    private function disambiguateEvent(Collection $guessedEvents): string
    {
        warning('I\'m not sure which class you choose...');

        return select(
            label: 'Which one should I choose ?',
            options: $guessedEvents->keyBy(fn (string $fqcn) => $fqcn)
        );
    }
}
