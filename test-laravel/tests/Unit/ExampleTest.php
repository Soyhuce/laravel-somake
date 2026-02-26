<?php declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
class ExampleTest extends TestCase
{
    #[Test]
    public function basicTest(): void
    {
        $this->assertTrue(true);
    }
}
