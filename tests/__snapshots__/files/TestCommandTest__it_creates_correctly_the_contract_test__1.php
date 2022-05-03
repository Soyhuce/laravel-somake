<?php

namespace Tests\Contract\Website\Videos\Video;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Website\Videos\Controllers\VideoController
 */
class ContractShowVideoTest extends TestCase
{
    /**
     * @test
     * @covers ::show
     */
    public function success(): void
    {
        $this->getJson("/api/videos/{$video}")
            ->assertValidContract(200);
    }
}
