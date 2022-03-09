<?php declare(strict_types=1);

namespace Domain\User\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $name;

    public string $email;

    public ?Carbon $email_verified_at;
}
