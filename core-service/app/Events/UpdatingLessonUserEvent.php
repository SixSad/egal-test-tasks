<?php

namespace App\Events;

use App\Models\LessonUser;
use Sixsad\Helpers\SessionAttributes;

class UpdatingLessonUserEvent extends AbstractServiceEvent
{
    public array $attributes;

    public function __construct(LessonUser $lessonUser)
    {
        parent::__construct($lessonUser);
        $this->setAttribute();
    }

    public function setAttribute(): void
    {
        $this->attributes = SessionAttributes::getAttributes();
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

}
