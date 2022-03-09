<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait AsksModel
{
    /**
     * @param \Illuminate\Support\Collection<string> $models
     */
    protected function askModel(Collection $models): string
    {
        if ($this->hasOption('model') && $this->option('model') !== null) {
            return $this->option('model');
        }

        if ($models->isEmpty()) {
            return $this->ask('What is the Model ? Please provide full qualified class name');
        }

        $this->showModels($models);

        $model = $this->anticipate(
            'What is the Model ?',
            $models->merge($models->map(fn (string $model) => class_basename($model)))->sort()->all()
        );

        if ($models->contains($model)) {
            return $model;
        }

        $guessedModels = $models->filter(fn (string $fqcn) => Str::lower(class_basename($fqcn)) === Str::lower($model));

        return match ($guessedModels->count()) {
            0 => $this->qualifyModel($model),
            1 => $guessedModels->first(),
            default => $this->disambiguateModel($guessedModels)
        };
    }

    /**
     * @param \Illuminate\Support\Collection<int, string> $models
     */
    protected function showModels(Collection $models): void
    {
        $this->info(sprintf('I detected %d %s.', $models->count(), Str::plural('models', $models->count())));

        $table = $models->map(
            fn (string $model) => [
                Str::between($model, 'Domain\\', '\\Models\\'),
                class_basename($model),
            ]
        )
            ->sort(function (array $first, array $second) {
                if ($first[0] === $second[0]) {
                    return strcmp($first[1], $second[1]);
                }

                return strcmp($first[0], $second[0]);
            });

        $this->table(['Domain', 'Model'], $table);
    }

    private function qualifyModel(string $model): string
    {
        if (class_exists($model)) {
            return $model;
        }
        $this->error("I did not found {$model} class.");

        return $this->ask('What is the Model ? Please provide full qualified class name');
    }

    /**
     * @param \Illuminate\Support\Collection<int, string> $models
     */
    private function disambiguateModel(Collection $models): string
    {
        $this->info('I\'m not sure which model you choose...');

        return $this->choice('Which one should I choose ?', $models->values()->all());
    }
}
