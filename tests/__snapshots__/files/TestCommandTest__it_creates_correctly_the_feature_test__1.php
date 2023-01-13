<?php

/* @covers \App\Website\Videos\Controllers\VideoController::show */

it('is successful', function (): void {
    $this->getJson("api/videos/{$video}")
        ->assertOk();
});
