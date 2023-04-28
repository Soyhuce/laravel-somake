<?php

/* @covers \Support\Http\Middleware\RedirectIfAuthenticated */

use Support\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

it('handles the request', function(): void {
    Route::get('test', fn() => 'ok')
        ->middleware(RedirectIfAuthenticated::class);

    $this->get('test')
        ->assertOk();
});
