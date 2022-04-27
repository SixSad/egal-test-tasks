<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;
use App\Exceptions\UUIDException;


class CheckUserUUIDListener
{
    /**
     * @throws UUIDException
     */
    public function handle(CourseUserCreatingEvent $event): void
    {
        $model = $event->getModel();
        $uuid = $event->getUuid();

        if ($model->getAttribute('user_id') !== $uuid) {
            throw new UUIDException();
        }
    }

}
