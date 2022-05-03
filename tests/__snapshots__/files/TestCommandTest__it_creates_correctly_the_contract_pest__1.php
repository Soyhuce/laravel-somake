<?php

/* @covers \App\Website\Videos\Controllers\VideoController::update */

it('respects success contract', function (): void {
    $this->putJson("api/videos/{$video}")
        ->assertValidContract(200);
});
