<?php

/* @covers \App\Website\Videos\Controllers\VideoController::defineMe */

it('is successful', function (): void {
    $this->getJson("/")
        ->assertOk();
});
