<?php

namespace App\Listeners;

use App\Events\UpdatingLessonUserEvent;
use Egal\Model\Exceptions\ValidateException;
use App\Helpers\CoreValidator;
use App\Exceptions\{
    AlreadyPassedException,
    WrongAttibuteException,
    WrongLessonIdException,
};

class CheckUpdatingFieldsListener
{
    /**
     * @throws WrongLessonIdException
     * @throws AlreadyPassedException
     * @throws WrongAttibuteException|ValidateException
     */
    public function handle(UpdatingLessonUserEvent $event): void
    {
        $model = $event->getModel();
        $attributes = $event->getAttributes();
        $userUUID = $event->getUuid();

        $wrongAttributes = array_diff_key($attributes, ['id' => '', 'is_passed' => '']);

        if (!empty($wrongAttributes)) {
            throw new WrongAttibuteException();
        }

        if ($event->getModel()->getAttribute('user_id') !== $userUUID) {
            throw new WrongLessonIdException();
        }

        $isPassed = $model->getAttribute('is_passed');

        if ($isPassed === true) {
            throw new AlreadyPassedException();
        }

        CoreValidator::validate($model->getAttributes(), [
            'lesson_id' => 'end_course',
        ]);
    }
}
