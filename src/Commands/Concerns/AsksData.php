<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

trait AsksData
{
    use WrapsSuggestions;

    /**
     * @param \Illuminate\Support\Collection<int, class-string<\Spatie\LaravelData\Data>> $datas
     * @return class-string<\Spatie\LaravelData\Data>
     */
    protected function askData(Collection $datas): string
    {
        if ($datas->isEmpty()) {
            return text(
                label: 'What is the Data ?',
                placeholder: 'Domain\\TheDomain\\Data\\TheData',
                required: true
            );
        }

        $data = suggest(
            label: 'What is the Data ?',
            options: $this->wrapSuggestions(
                $datas->map(fn (string $data) => class_basename($data))
                    ->sort()
                    ->merge($datas->sort())
            ),
            required: true
        );

        if ($datas->contains($data)) {
            return $data;
        }

        $guessedDatas = $datas->filter(fn (string $fqcn) => Str::lower(class_basename($fqcn)) === Str::lower($data));

        return match ($guessedDatas->count()) {
            0 => $this->qualifyData($data),
            1 => $guessedDatas->first(),
            default => $this->disambiguateDatas($guessedDatas)
        };
    }

    /**
     * @return class-string<\Spatie\LaravelData\Data>
     */
    private function qualifyData(string $data): string
    {
        if (class_exists($data)) {
            return $data;
        }
        warning("I did not found {$data} class.");

        return text(
            label: 'What is the Data ?',
            placeholder: 'Domain\\TheDomain\\Data\\TheData',
            required: true
        );
    }

    /**
     * @param \Illuminate\Support\Collection<int, class-string<\Spatie\LaravelData\Data>> $datas
     */
    private function disambiguateDatas(Collection $datas): string
    {
        warning('I\'m not sure which data you choose...');

        return select(
            label: 'Which one should I choose ?',
            options: $datas
        );
    }
}
