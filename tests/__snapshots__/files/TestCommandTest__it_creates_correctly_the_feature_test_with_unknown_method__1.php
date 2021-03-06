<?php

namespace Tests\Feature\Website\Videos\VideoController;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Website\Videos\Controllers\VideoController
 */
class IndexVideosTest extends TestCase
{
    /**
     * @test
     * @covers ::index
     */
    public function simple(): void
    {
        $this->getJson("/")
            ->assertOk();
    }
}
