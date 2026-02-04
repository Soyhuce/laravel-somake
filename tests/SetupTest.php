<?php declare(strict_types=1);

namespace Soyhuce\Somake\Tests;

use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Support\BaseApplication;

#[CoversNothing]
class SetupTest extends TestCase
{
    use RestoreTestApplication;

    #[Test]
    public function applicationIsTheGoodOne(): void
    {
        $this->assertInstanceOf(BaseApplication::class, $this->app);
    }

    #[Test]
    public function applicationBasePathIsCorrectlySet(): void
    {
        $this->assertEquals(realpath(__DIR__ . '/../test-laravel'), $this->app->basePath());
    }

    #[Test]
    public function generatedFilesGoInTheRightPlace(): void
    {
        Carbon::setTestNow(now());

        $this->artisan('make:migration create_posts_table')
            ->assertExitCode(0);

        $filename = now()->format('Y_m_d_His') . '_create_posts_table.php';
        $this->assertFileExists($this->app->basePath("database/migrations/{$filename}"));
    }
}
