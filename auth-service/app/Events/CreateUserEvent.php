<?php

namespace App\Events;

use App\Models\User;
use Egal\Core\Events\Event;
use Egal\Core\Session\Session;

class CreateUserEvent extends Event
{

    public User $user;
    public array $attributes;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->attributes = Session::getActionMessage()->getParameters()['attributes'];
    }

    public function getModel(): User
    {
        return $this->user;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

}
