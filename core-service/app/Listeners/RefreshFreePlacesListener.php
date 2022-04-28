<?php

namespace App\Listeners;

use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\Course;

class RefreshFreePlacesListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();
        /** @var Course $course */
        $course = Course::query()->find($model->getAttribute('course_id'));
        $course->update([
            'student_capacity' => $course->student_capacity - 1,
        ]);
    }
}
