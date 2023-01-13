<?php declare(strict_types=1);

namespace App\Website\Videos\Controllers;

use Illuminate\Http\Response;

class InvokableVideoController
{
    public function __invoke(int $video): Response
    {
        return response()->noContent();
    }
}
