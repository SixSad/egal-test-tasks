<?php

namespace App\Events;

use App\Models\LessonUser;

class UpdatedLessonUserEvent extends AbstractServiceEvent
{
    public function __construct(LessonUser $lessonUser)
    {
        parent::__construct($lessonUser);
    }
}
