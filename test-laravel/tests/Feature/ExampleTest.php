<?php declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function basicTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
