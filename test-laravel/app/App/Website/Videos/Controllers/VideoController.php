<?php declare(strict_types=1);

namespace App\Website\Videos\Controllers;

use Illuminate\Http\Response;

class VideoController
{
    public function show(int $video): Response
    {
        return response()->noContent();
    }
}
