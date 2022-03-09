<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests;

use Illuminate\Support\Carbon;
use Support\BaseApplication;

/**
 * @coversNothing
 */
class SetupTest extends TestCase
{
    use RestoreTestApplication;

    /**
     * @test
     */
    public function applicationIsTheGoodOne(): void
    {
        $this->assertInstanceOf(BaseApplication::class, $this->app);
    }

    /**
     * @test
     */
    public function applicationBasePathIsCorrectlySet(): void
    {
        $this->assertEquals(realpath(__DIR__ . '/../test-laravel'), $this->app->basePath());
    }

    /**
     * @test
     */
    public function generatedFilesGoInTheRightPlace(): void
    {
        Carbon::setTestNow(now());

        $this->artisan('make:migration create_posts_table')
            ->assertExitCode(0);

        $filename = now()->format('Y_m_d_His') . '_create_posts_table.php';
        $this->assertFileExists($this->app->basePath("database/migrations/{$filename}"));
    }
}
