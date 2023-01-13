<?php

/* @covers \App\Website\Videos\Controllers\VideoController::index */

it('is successful', function (): void {
    $this->getJson("/")
        ->assertOk();
});
