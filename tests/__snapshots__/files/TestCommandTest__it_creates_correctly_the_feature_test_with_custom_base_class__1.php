<?php

namespace Tests\Feature\Website\Videos\VideoController;

use Tests\FeatureTestCase;

/**
 * @coversDefaultClass \App\Website\Videos\Controllers\VideoController
 */
class ShowVideoTest extends FeatureTestCase
{
    /**
     * @test
     * @covers ::defineMe
     */
    public function simple(): void
    {
        $this->getJson("/")
            ->assertOk();
    }
}
