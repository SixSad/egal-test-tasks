<?php

namespace App\Listeners;

use App\Helpers\AbstractListener;
use App\Helpers\AbstractServiceEvent;
use App\Models\Course;

class RefreshFreePlacesListener extends AbstractListener
{
    public function handle(AbstractServiceEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();
        /** @var Course $course */
        $course = Course::query()->findOrFail($model->getAttribute('course_id'));
        $course->update([
            'student_capacity' => $course->student_capacity - 1,
        ]);
    }
}
