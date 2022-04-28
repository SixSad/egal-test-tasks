<?php

namespace App\Events;

use App\Helpers\AbstractEvent;
use App\Models\LessonUser;

class UpdatedLessonUserEvent extends AbstractEvent
{
    public LessonUser $lessonUser;

    public function __construct(LessonUser $lessonUser)
    {
        parent::__construct($lessonUser);
    }

}
