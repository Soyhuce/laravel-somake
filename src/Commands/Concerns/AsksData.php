<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait AsksData
{
    /**
     * @param \Illuminate\Support\Collection<int, class-string<\Spatie\LaravelData\Data>> $datas
     * @return class-string<\Spatie\LaravelData\Data>
     */
    protected function askData(Collection $datas): string
    {
        if ($datas->isEmpty()) {
            return $this->ask('What is the Data ? Please provide full qualified class name');
        }

        $data = $this->anticipate(
            'What is the Data ?',
            $this->wrapCallable($datas->merge($datas->map(fn (string $data) => class_basename($data)))->sort()->all())
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
        $this->error("I did not found {$data} class.");

        return $this->ask('What is the Data ? Please provide full qualified class name');
    }

    /**
     * @param \Illuminate\Support\Collection<int, class-string<\Spatie\LaravelData\Data>> $datas
     */
    private function disambiguateDatas(Collection $datas): string
    {
        $this->info('I\'m not sure which dto you choose...');

        return $this->choice('Which one should I choose ?', $datas->values()->all());
    }
}