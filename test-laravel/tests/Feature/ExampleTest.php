<?php declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversNothing]
class ExampleTest extends TestCase
{
    #[Test]
    public function basicTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
