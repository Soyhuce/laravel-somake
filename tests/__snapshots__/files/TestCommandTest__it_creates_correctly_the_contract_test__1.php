<?php

namespace Tests\Contract\Website\Videos\Video;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Website\Videos\Controllers\VideoController
 */
class ContractUpdateVideoTest extends TestCase
{
    /**
     * @test
     * @covers ::update
     */
    public function success(): void
    {
        $this->putJson("api/videos/{$video}")
            ->assertValidContract(200);
    }
}
