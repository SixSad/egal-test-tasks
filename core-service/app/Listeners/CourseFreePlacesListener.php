<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;
use App\Exceptions\FreePlaceException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\Course;
use Egal\Model\Exceptions\NotFoundException;

class CourseFreePlacesListener extends AbstractListener
{
    /**
     * @param CourseUserCreatingEvent $event
     * @return void
     * @throws FreePlaceException
     * @throws NotFoundException
     */
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();
        $course = Course::query()->find($model->getAttribute('course_id'));
        if (!$course) {
            throw new NotFoundException();
        }
        if ($course->getAttribute('student_capacity') < 1) {
            throw new FreePlaceException();
        }
    }

}
