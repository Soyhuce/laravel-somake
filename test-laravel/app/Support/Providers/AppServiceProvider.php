<?php declare(strict_types=1);

namespace Support\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static function (string $modelFqcn): string {
            // Transforms Domain\TheDomain\Models\TheModel to Database\Factories\TheDomain\TheModelFactory
            return str_replace(['Domain', 'Models\\'], ['Database\Factories', ''], $modelFqcn) . 'Factory';
        });
    }
}
