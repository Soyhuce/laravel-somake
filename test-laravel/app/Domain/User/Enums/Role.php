<?php declare(strict_types=1);

namespace Domain\User\Enums;

enum Role: string
{
    case Admin = 'admin';
    case User = 'user';
}
