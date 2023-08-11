<?php

namespace Domain\Blog\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
    }
}
