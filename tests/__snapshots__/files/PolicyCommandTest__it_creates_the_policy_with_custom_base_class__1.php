<?php

namespace Domain\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Support\Policy;

class UserPolicy extends Policy
{
    use HandlesAuthorization;
}
