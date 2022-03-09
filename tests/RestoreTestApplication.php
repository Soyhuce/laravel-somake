<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests;

use Illuminate\Support\Facades\File;

trait RestoreTestApplication
{
    protected $foldersToBackup = ['app', 'database', 'tests'];

    protected function bootApplicationRestoration(): void
    {
        $this->backupApplication();

        $this->beforeApplicationDestroyed(function (): void {
            $this->restoreApplication();
        });
    }

    protected function backupApplication(): void
    {
        foreach ($this->foldersToBackup as $folder) {
            File::deleteDirectory(__DIR__ . '/../phpunit/test-laravel-backup/' . $folder);
            File::copyDirectory(__DIR__ . '/../test-laravel/' . $folder, __DIR__ . '/../phpunit/test-laravel-backup/' . $folder);
        }
    }

    protected function restoreApplication(): void
    {
        foreach ($this->foldersToBackup as $folder) {
            File::deleteDirectory(__DIR__ . '/../test-laravel/' . $folder);
            File::copyDirectory(__DIR__ . '/../phpunit/test-laravel-backup/' . $folder, __DIR__ . '/../test-laravel/' . $folder);
        }
    }
}
