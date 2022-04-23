<?php

namespace App\Listeners;

use App\Events\CourseUserCreatedEvent;
use App\Models\Course;

class RefreshFreePlacesListener
{

    public function handle(CourseUserCreatedEvent $event): void
    {
        $model = $event->getModel();
        $course = Course::firstWhere("id", $model->getAttribute('course_id'));
        $course->update([
            'student_capacity' => $course->student_capacity - 1,
        ]);
    }

}
