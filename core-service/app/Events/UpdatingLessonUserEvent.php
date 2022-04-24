<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;
use Illuminate\Queue\SerializesModels;

class UpdatingLessonUserEvent extends Event
{

    use SerializesModels;

    public LessonUser $lessonUser;

    public function __construct(LessonUser $lessonUser)
    {
        $this->lessonUser = $lessonUser;
    }

    public function getModel(): LessonUser
    {
        return $this->lessonUser ;
    }
}
