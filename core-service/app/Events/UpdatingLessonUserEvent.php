<?php

namespace App\Events;

use App\Helpers\AbstractServiceEvent;
use App\Models\LessonUser;
use Egal\Core\Session\Session;

class UpdatingLessonUserEvent extends AbstractServiceEvent
{
    public array $attributes;

    public function __construct(LessonUser $lessonUser)
    {
        parent::__construct($lessonUser);
        $this->attributes = Session::getActionMessage()->getParameters()['attributes'];
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
