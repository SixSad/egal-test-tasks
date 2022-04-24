<?php

namespace App\Listeners;

use App\Events\UpdatingLessonUserEvent;
use App\Exceptions\UUIDException;
use App\Exceptions\WrongAttibuteException;
use App\Exceptions\WrongLessonIdException;
use Egal\Core\Session\Session;


class CheckUpdatingFieldsListener
{

    public function handle(UpdatingLessonUserEvent $event): void
    {
        $attributes = Session::getActionMessage()->getParameters()['attributes'];
        $userUUID = Session::getUserServiceToken()->getUid();
        $wrongAttributes = array_diff_key($attributes, ['id' => '', 'is_passed' => '']);
        $

        if (!empty($wrongAttributes)) {
            throw new WrongAttibuteException();
        }

        if ($event->getModel()->getAttribute('user_id') !== $userUUID) {
            throw new WrongLessonIdException();
        }
    }

}
