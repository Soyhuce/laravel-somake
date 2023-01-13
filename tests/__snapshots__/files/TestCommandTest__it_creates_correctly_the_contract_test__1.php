<?php

/* @covers \App\Website\Videos\Controllers\VideoController::show */

it('respects success contract', function (): void {
    $this->getJson("api/videos/{$video}")
        ->assertValidContract(200);
});
