<?php

namespace App\Events;

use App\Models\CourseUser;
use Egal\Core\Events\Event;
use Illuminate\Queue\SerializesModels;

class CourseUserCreatingEvent extends Event
{
    use SerializesModels;

    public $courseUser;

    public function __construct(CourseUser $courseUser)
    {
        $this->courseUser = $courseUser;
    }

}
