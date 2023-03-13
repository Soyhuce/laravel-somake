<?php declare(strict_types=1);

namespace Domain\User\Data;

use Carbon\Carbon;
use Domain\User\Enums\Role;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?Carbon $email_verified_at,
        public Role $role,
    ) {
    }
}
