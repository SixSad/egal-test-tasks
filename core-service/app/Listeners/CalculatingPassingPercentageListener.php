<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;
use App\Helpers\AbstractListener;
use App\Helpers\AbstractServiceEvent;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonUser;
use Egal\Model\Exceptions\NotFoundException;

class CalculatingPassingPercentageListener extends AbstractListener
{
    /**
     * @param UpdatedLessonUserEvent $event
     * @return void
     * @throws NotFoundException
     */
    public function handle(AbstractServiceEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();
        $course = Lesson::query()->findOrFail($model->getAttribute('lesson_id'))->course;
        $countLessons = $course->lessons->count();

        $courseUser = CourseUser::query()->where([
            'course_id' => $course->getAttribute('id'),
            'user_id' => $model->getAttribute('user_id')
        ]);

        $countPassed = LessonUser::query()->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->where([
                'user_id' => $model->getAttribute('user_id'),
                'is_passed' => true
            ])->count();

        $courseUser->update(['percentage_passing' => (int)(($countPassed / $countLessons) * 100)]);
    }

}
