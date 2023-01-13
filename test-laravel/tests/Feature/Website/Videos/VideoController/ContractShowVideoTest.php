<?php declare(strict_types=1);

/* @covers \App\Website\Videos\Controllers\VideoController::show */

it('is successful', function (): void {
    $this->getJson("api/videos/{$video}")
        ->assertValidContract(200);
});
