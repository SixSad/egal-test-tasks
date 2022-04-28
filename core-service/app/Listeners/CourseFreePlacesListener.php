<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;
use App\Exceptions\FreePlaceException;
use App\Models\Course;
use App\Models\CourseUser;
use Egal\Model\Exceptions\NotFoundException;


class CourseFreePlacesListener
{
    /**
     * @param CourseUserCreatingEvent $event
     * @return void
     * @throws FreePlaceException
     * @throws NotFoundException
     */
    public function handle(CourseUserCreatingEvent $event): void
    {
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
