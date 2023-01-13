<?php

/* @covers \App\Website\Videos\Controllers\InvokableVideoController::__invoke */

it('is successful', function (): void {
    $this->putJson("api/videos-invokable/{$video}")
        ->assertOk();
});
