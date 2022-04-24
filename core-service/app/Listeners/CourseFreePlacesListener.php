<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;
use App\Exceptions\FreePlaceException;
use App\Models\Course;
use App\Models\CourseUser;


class CourseFreePlacesListener
{
    /**
     * @throws FreePlaceException
     */
    public function handle(CourseUserCreatingEvent $event): void
    {
        $model = $event->getModel();
        $course = Course::firstWhere("id", $model->getAttribute('course_id'));

        if ($course->getAttribute('student_capacity') < 1) {
            throw new FreePlaceException();
        }
    }

}
