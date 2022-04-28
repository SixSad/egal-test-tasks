<?php

namespace App\Events;

use App\Helpers\AbstractEvent;
use App\Models\CourseUser;

class CourseUserCreatingEvent extends AbstractEvent
{
    public CourseUser $courseUser;

    public function __construct(CourseUser $courseUser)
    {
        parent::__construct($courseUser);
    }
}
