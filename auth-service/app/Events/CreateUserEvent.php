<?php

namespace App\Events;

use App\Models\User;
use Egal\Core\Events\Event;

class CreateUserEvent extends Event
{

    public User $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
