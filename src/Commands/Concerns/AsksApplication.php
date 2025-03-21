<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands\Concerns;

use Illuminate\Support\Collection;
use function Laravel\Prompts\suggest;

trait AsksApplication
{
    use WrapsSuggestions;

    /**
     * @param Collection<int, string> $applications
     */
    protected function askApplication(Collection $applications): string
    {
        return suggest(
            label: 'What is the Application ?',
            options: $this->wrapSuggestions($applications),
            required: true
        );
    }

    /**
     * @param Collection<int, string>|null $domains
     */
    protected function askOptionalNamespace(string $classname, ?Collection $domains = null): string
    {
        return suggest(
            label: "You may want {$classname} to live in a sub namespace. Which one ?",
            options: $this->wrapSuggestions($domains ?? Collection::make()),
            placeholder: 'Leave it empty if you want to leave it in root namespace.'
        );
    }
}
