<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;
use Egal\Core\Session\Session;
use Illuminate\Queue\SerializesModels;

class UpdatingLessonUserEvent extends Event
{
    public LessonUser $lessonUser;
    public array $attributes;
    public string $uuid;

    public function __construct(LessonUser $lessonUser)
    {
        $this->lessonUser = $lessonUser;
        $this->attributes = Session::getActionMessage()->getParameters()['attributes'];
        $this->uuid = Session::getUserServiceToken()->getUid();
    }

    public function getModel(): LessonUser
    {
        return $this->lessonUser;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
