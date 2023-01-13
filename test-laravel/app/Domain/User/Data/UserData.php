<?php declare(strict_types=1);

namespace Domain\User\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public string $name;

    public string $email;

    public ?Carbon $email_verified_at;
}
