<?php declare(strict_types=1);

/* @covers \App\Website\Videos\Requests\UpdateVideoRequest */

use App\Website\Videos\Requests\UpdateVideoRequest;

it('passes validation', function (): void {
    $this->createRequest(UpdateVideoRequest::class)
        ->validate([
            'title' => null,
            'description' => null,
            'published_at' => null,
        ])
        ->assertPasses();
});
