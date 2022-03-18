<?php

/* @covers \App\Website\Videos\Controllers\VideoController::defineMe */

it('respects success contract', function (): void {
    $this->get('/')
        ->assertValidContract(200);
});
