<?php

namespace App\Events;

use App\Models\LessonUser;

class UpdatingLessonUserEvent extends AbstractServiceEvent
{
    public array $attributes;

    public function __construct(LessonUser $lessonUser)
    {
        parent::__construct($lessonUser);
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
