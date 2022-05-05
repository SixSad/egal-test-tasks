<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Session\Session;

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
