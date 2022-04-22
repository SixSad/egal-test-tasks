<?php

namespace App\Events;
use App\Models\User;
use Egal\Core\Events\Event;
use Illuminate\Queue\SerializesModels;


class CreateUserEvent extends Event
{
    use SerializesModels;

    public $user;
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
