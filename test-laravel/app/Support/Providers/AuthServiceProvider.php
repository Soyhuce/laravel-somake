<?php declare(strict_types=1);

namespace Support\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::guessPolicyNamesUsing(
            static fn (string $modelClass): string => Str::replaceFirst('Models', 'Policies', $modelClass) . 'Policy'
        );
    }
}
