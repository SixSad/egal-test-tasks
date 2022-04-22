<?php

namespace App\Events;

use App\Models\CourseUser;
use Egal\Core\Events\Event;
use Illuminate\Queue\SerializesModels;

class CreateCourseUserEvent extends Event
{
    use SerializesModels;
    public $courseUser;

    /**
     * Create a new event instance.
     *
     * @param CourseUser $courseUser
     */
    public function __constructor(CourseUser $courseUser)
    {
        $this->courseUser = $courseUser;
    }
}
