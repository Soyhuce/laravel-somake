<?php declare(strict_types=1);

namespace Soyhuce\Somake\Commands;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Collection;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Soyhuce\Somake\Support\FileWritten;
use SplFileInfo;

class MigrationCommand extends MigrateMakeCommand
{
    public function __construct(MigrationCreator $creator, Composer $composer)
    {
        $this->signature = Str::replace('make:migration', 'somake:migration', $this->signature);

        parent::__construct($creator, $composer);
    }

    public function handle(): void
    {
        $initialFiles = (new Collection(File::allFiles($this->getMigrationPath())))
            ->map(fn (SplFileInfo $file) => $file->getPathname());

        parent::handle();

        $finalFiles = (new Collection(File::allFiles($this->getMigrationPath())))
            ->map(fn (SplFileInfo $file) => $file->getPathname());

        $finalFiles->diff($initialFiles)->each(function (string $file): void {
            Event::dispatch(new FileWritten($file));
        });
    }
}
