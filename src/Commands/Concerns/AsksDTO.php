<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait AsksDTO
{
    /**
     * @param \Illuminate\Support\Collection<string> $dtos
     * @return class-string<\Spatie\DataTransferObject\DataTransferObject>
     */
    protected function askDTO(Collection $dtos): string
    {
        if ($dtos->isEmpty()) {
            return $this->ask('What is the DTO ? Please provide full qualified class name');
        }

        $dto = $this->anticipate(
            'What is the DTO ?',
            $dtos->merge($dtos->map(fn (string $dto) => class_basename($dto)))->sort()->all()
        );

        if ($dtos->contains($dto)) {
            return $dto;
        }

        $guessedDTo = $dtos->filter(fn (string $fqcn) => Str::lower(class_basename($fqcn)) === Str::lower($dto));

        return match ($guessedDTo->count()) {
            0 => $this->qualifyDto($dto),
            1 => $guessedDTo->first(),
            default => $this->disambiguateDtos($guessedDTo)
        };
    }

    private function qualifyDto(mixed $dto): string
    {
        if (class_exists($dto)) {
            return $dto;
        }
        $this->error("I did not found {$dto} class.");

        return $this->ask('What is the DTO ? Please provide full qualified class name');
    }

    /**
     * @param \Illuminate\Support\Collection<int, string> $dtos
     */
    private function disambiguateDtos(Collection $dtos): string
    {
        $this->info('I\'m not sure which dto you choose...');

        return $this->choice('Which one should I choose ?', $dtos->values()->all());
    }
}
