<?php declare(strict_types=1);

it('creates the migration correctly', function (): void {
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

    expect($filename)->toMatchFileSnapshot();
});
