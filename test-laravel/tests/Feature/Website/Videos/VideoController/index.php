<?php declare(strict_types=1);

namespace Tests\Feature\Website\Videos\VideoController;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Website\Videos\Controllers\VideoController
 */
class index extends TestCase
{
    /**
     * @test
     * @covers ::defineMe
     */
    public function simple(): void
    {
        $this->getJson('/')
            ->assertOk();
    }
}
