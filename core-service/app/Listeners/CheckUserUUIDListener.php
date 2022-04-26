<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;
use Egal\Core\Session\Session;
use App\Exceptions\UUIDException;


class CheckUserUUIDListener
{

    public function __construct()
    {

    }

    /**
     * @throws UUIDException
     */
    public function handle(CourseUserCreatingEvent $event): void
    {
        $model = $event->getModel();

        if ($model->getAttribute('user_id') !== Session::getUserServiceToken()->getUid()) {
            var_dump($model->getAttribute('user_id'));
            var_dump(Session::getUserServiceToken()->getUid());
            throw new UUIDException();
        }
    }

}
