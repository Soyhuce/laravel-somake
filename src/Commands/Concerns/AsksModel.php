<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

trait AsksModel
{
    use WrapsSuggestions;

    /**
     * @param Collection<int, class-string<\Illuminate\Database\Eloquent\Model>> $models
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function askModel(Collection $models): string
    {
        if ($this->hasOption('model') && $this->option('model') !== null) {
            return $this->option('model');
        }

        if ($models->isEmpty()) {
            return text(
                label: 'What is the Model ?',
                placeholder: 'Domain\\TheDomain\\Models\\TheModel',
                required: true
            );
        }

        $model = suggest(
            label: 'What is the Model ?',
            options: $this->wrapSuggestions(
                $models->map(fn (string $model) => class_basename($model))
                    ->sort()
                    ->merge($models->sort())
            ),
            required: true,
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

    private function qualifyModel(string $model): string
    {
        if (class_exists($model)) {
            return $model;
        }
        warning("I did not found {$model} class.");

        return text(
            label: 'What is the Model ?',
            placeholder: 'Domain\\TheDomain\\Models\\TheModel',
            required: true
        );
    }

    /**
     * @param Collection<int, class-string<\Illuminate\Database\Eloquent\Model>> $models
     */
    private function disambiguateModel(Collection $models): string
    {
        warning('I\'m not sure which model you choose...');

        return select(
            label: 'Which one should I choose ?',
            options: $models->keyBy(fn (string $fqcn) => $fqcn),
        );
    }
}
