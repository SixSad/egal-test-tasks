<?php

namespace App\Events;

use App\Models\CourseUser;
use Egal\Core\Events\Event;
use Egal\Core\Session\Session;

class CourseUserCreatingEvent extends Event
{
    public CourseUser $courseUser;
    public string $uuid;

    public function __construct(CourseUser $courseUser)
    {
        $this->courseUser = $courseUser;
        $this->uuid = Session::getUserServiceToken()->getUid();
    }

    public function getModel(): CourseUser
    {
        return $this->courseUser;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
