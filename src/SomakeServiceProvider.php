<?php

namespace Soyhuce\Somake;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Soyhuce\Somake\Commands\SomakeCommand;

class SomakeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-somake')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-somake_table')
            ->hasCommand(SomakeCommand::class);
    }
}
