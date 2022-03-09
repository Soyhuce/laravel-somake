<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Soyhuce\Somake\Tests\RestoreTestApplication;
use Soyhuce\Somake\Tests\TestCase;
use SplFileInfo;

/**
 * @coversNothing
 */
class MigrationCommand extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function theMigrationIsCorrectlyCreated(): void
    {
        $this->artisan('somake:migration create_tests_table')
            ->assertExitCode(0)
            ->execute();

        $this->assertCount(
            1,
            collect(File::allFiles($this->app->basePath('database/migrations')))
                ->map(fn (SplFileInfo $file) => $file->getFilename())
                ->filter(fn (string $filename) => Str::endsWith($filename, '_create_tests_table.php'))
        );

        $filename = collect(File::allFiles($this->app->basePath('database/migrations')))
            ->map(fn (SplFileInfo $file) => $file->getPathname())
            ->filter(fn (string $filename) => Str::endsWith($filename, '_create_tests_table.php'))
            ->first();

        $this->assertFileEquals(
            $this->expectedPath('Migrations/CreateTestTable.php.stub'),
            $filename
        );
    }
}
