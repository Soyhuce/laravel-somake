<?php

/* @covers \App\Website\Videos\Requests\UpdateVideoRequest */

use App\Website\Videos\Requests\UpdateVideoRequest;

it('passes validation', function (): void {
    $this->createRequest(UpdateVideoRequest::class)
        ->validate([
            'title' => '',
            'description' => '',
            'published_at' => '',
        ])
        ->assertPasses();
});
