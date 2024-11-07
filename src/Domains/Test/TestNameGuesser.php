<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test;

use Illuminate\Support\Str;
use function sprintf;

class TestNameGuesser
{
    public function guess(string $controller, string $method): string
    {
        $entity = Str::of($controller)->classBasename()->beforeLast('Controller');

        $method = match ($method) {
            'store' => 'create',
            'destroy' => 'delete',
            default => $method,
        };

        if ($method === 'index') {
            $entity = $entity->plural();
        }

        return sprintf(
            '%s%sTest',
            Str::ucfirst($method),
            $entity->ucfirst()->toString()
        );
    }
}
