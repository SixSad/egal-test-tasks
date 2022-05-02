<?php

namespace App\Events;

use App\Helpers\AbstractEvent;
use App\Models\User;
use Egal\Core\Session\Session;

class  CreateUserEvent extends AbstractEvent
{
    public array $attributes;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->attributes = Session::getActionMessage()->getParameters()['attributes'];
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
