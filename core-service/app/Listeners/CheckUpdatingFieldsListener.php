<?php

namespace App\Listeners;

use App\Events\UpdatingLessonUserEvent;
use App\Exceptions\AlreadyPassedException;
use App\Exceptions\WrongAttibuteException;
use App\Exceptions\WrongLessonIdException;
use App\Models\LessonUser;
use Egal\Core\Session\Session;


class CheckUpdatingFieldsListener
{

    /**
     * @throws WrongLessonIdException
     * @throws AlreadyPassedException
     * @throws WrongAttibuteException
     */
    public function handle(UpdatingLessonUserEvent $event): void
    {
        $model = $event->getModel();

        $attributes = Session::getActionMessage()->getParameters()['attributes'];
        $userUUID = Session::getUserServiceToken()->getUid();
        $wrongAttributes = array_diff_key($attributes, ['id' => '', 'is_passed' => '']);
        $isPassed = LessonUser::query()->find($model->id)->getAttribute('is_passed');

        if ($isPassed === true) {
            throw new AlreadyPassedException();
        }

        if (!empty($wrongAttributes)) {
            throw new WrongAttibuteException();
        }

        if ($event->getModel()->getAttribute('user_id') !== $userUUID) {
            throw new WrongLessonIdException();
        }
    }

}
