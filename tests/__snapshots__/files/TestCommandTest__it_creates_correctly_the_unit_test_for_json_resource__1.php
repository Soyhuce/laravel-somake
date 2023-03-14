<?php

/* @covers \App\Admin\Resources\User\UserResource */

use App\Admin\Resources\User\UserResource;
use Domain\User\Models\User;

it('formats the user', function (): void {
    $user = User::factory()->createOne();

    $this->createResponse(UserResource::make($user))->assertData([
        'id' => '',
        'name' => '',
    ]);
});
