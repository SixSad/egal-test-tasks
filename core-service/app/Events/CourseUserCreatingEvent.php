<?php

namespace App\Events;

use App\Helpers\AbstractEvent;
use App\Models\CourseUser;
use Egal\Core\Session\Session;

class CourseUserCreatingEvent extends AbstractEvent
{
    public string $uuid;

    public function __construct(CourseUser $courseUser)
    {
        parent::__construct($courseUser);
        $this->uuid = Session::getUserServiceToken()->getUid();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
