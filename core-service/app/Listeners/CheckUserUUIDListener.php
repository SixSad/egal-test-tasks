<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;
use Egal\Core\Session\Session;
use App\Exceptions\UUIDException;


class CheckUserUUIDListener
{
    /**
     * @throws UUIDException
     */
    public function handle(CourseUserCreatingEvent $event): void
    {
        $model = $event->getModel();

        if ($model->getAttribute('user_id') !== Session::getUserServiceToken()->getUid()) {
            throw new UUIDException();
        }
    }

}
