<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Illuminate\Notifications\Notification;
use Soyhuce\Somake\Contracts\UnitTestGenerator;

/**
 * @implements \Soyhuce\Somake\Contracts\UnitTestGenerator<mixed>
 */
class NotificationTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        return is_subclass_of($class, Notification::class);
    }

    public function view(): string
    {
        return 'test-unit-notification';
    }

    public function data(string $class): array
    {
        return [];
    }
}
