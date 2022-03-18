<?php declare(strict_types=1);

namespace Soyhuce\Somake;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Facades\Event;
use Soyhuce\Somake\Commands\ActionCommand;
use Soyhuce\Somake\Commands\BuilderCommand;
use Soyhuce\Somake\Commands\CommandCommand;
use Soyhuce\Somake\Commands\ControllerCommand;
use Soyhuce\Somake\Commands\DtoCommand;
use Soyhuce\Somake\Commands\FactoryCommand;
use Soyhuce\Somake\Commands\MiddlewareCommand;
use Soyhuce\Somake\Commands\MigrationCommand;
use Soyhuce\Somake\Commands\ModelCommand;
use Soyhuce\Somake\Commands\PolicyCommand;
use Soyhuce\Somake\Commands\RequestCommand;
use Soyhuce\Somake\Commands\ResourceCommand;
use Soyhuce\Somake\Commands\TestCommand;
use Soyhuce\Somake\Support\Composer;
use Soyhuce\Somake\Support\FileOpener;
use Soyhuce\Somake\Support\FileWritten;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SomakeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-somake')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommands([
                ActionCommand::class,
                BuilderCommand::class,
                CommandCommand::class,
                ControllerCommand::class,
                DtoCommand::class,
                FactoryCommand::class,
                MiddlewareCommand::class,
                MigrationCommand::class,
                ModelCommand::class,
                PolicyCommand::class,
                RequestCommand::class,
                ResourceCommand::class,
                TestCommand::class,
            ]);
    }

    public function registeringPackage(): void
    {
        if ($this->app->runningInConsole()) {
            $this->app->singleton(Composer::class);
            $this->app->singleton(FileOpener::class);

            $this->app->singleton(MigrationCreator::class, function ($app) {
                return new MigrationCreator($app['files'], __DIR__ . '/../resources/stubs');
            });
        }
    }

    public function bootingPackage(): void
    {
        if ($this->app->runningInConsole()) {
            Event::listen(FileWritten::class, FileOpener::class);

            $this->app->terminating(function (FileOpener $fileOpener): void {
                $fileOpener->openFiles();
            });
        }
    }
}
