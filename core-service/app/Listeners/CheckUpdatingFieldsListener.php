<?php

namespace App\Listeners;

use App\Events\AbstractServiceEvent;
use App\Models\LessonUser;
use Egal\Model\Exceptions\ValidateException;
use App\Exceptions\{
    AlreadyPassedException,
    WrongAttibuteException,
    WrongLessonIdException,
};
use Sixsad\Helpers\ServiceValidator;

class CheckUpdatingFieldsListener extends AbstractListener
{
    /**
     * @throws WrongLessonIdException
     * @throws AlreadyPassedException
     * @throws WrongAttibuteException|ValidateException
     */
    public function handle(AbstractServiceEvent $event): void
    {
        parent::handle($event);
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

        $isPassed = LessonUser::query()->find($model->getAttribute('id'))->getAttribute('is_passed');

        if ($isPassed === true) {
            throw new AlreadyPassedException();
        }

        ServiceValidator::validate($model->getAttributes(), [
            'lesson_id' => 'end_course',
        ]);
    }
}
