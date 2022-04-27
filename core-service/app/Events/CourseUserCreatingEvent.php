<?php

namespace App\Events;

use App\Models\CourseUser;
use Egal\Core\Events\Event;
use Illuminate\Queue\SerializesModels;

class CourseUserCreatingEvent extends Event
{
    public CourseUser $courseUser;

    public function __construct(CourseUser $courseUser)
    {
        $this->courseUser = $courseUser;
    }

    public function getModel(): CourseUser
    {
        return $this->courseUser;
    }
}
