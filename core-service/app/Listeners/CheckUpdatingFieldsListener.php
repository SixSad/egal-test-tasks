<?php

namespace App\Listeners;

use App\Helpers\AbstractListener;
use App\Helpers\AbstractServiceEvent;
use App\Models\LessonUser;
use Egal\Model\Exceptions\ValidateException;
use App\Helpers\CoreValidator;
use App\Exceptions\{
    AlreadyPassedException,
    WrongAttibuteException,
    WrongLessonIdException,
};

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

        var_dump($model);
        var_dump($isPassed);
        if ($isPassed === true) {
            throw new AlreadyPassedException();
        }

        CoreValidator::validate($model->getAttributes(), [
            'lesson_id' => 'end_course',
        ]);
    }
}
