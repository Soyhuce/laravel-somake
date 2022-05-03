<?php declare(strict_types=1);

/* @covers \App\Website\Videos\Controllers\VideoController::defineMe */

it('respects success contract', function (): void {
    $this->getJson('/')
        ->assertValidContract(200);
});
