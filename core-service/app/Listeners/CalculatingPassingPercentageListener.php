<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;
use App\Exceptions\AlreadyPassedException;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonUser;


class CalculatingPassingPercentageListener
{

    public function handle(UpdatedLessonUserEvent $event): void
    {
        $model = $event->getModel();

        $course_id = Lesson::query()->find($model->getAttribute('lesson_id'))->getAttribute('course_id');

        $course = CourseUser::query()->firstWhere([
            'course_id' => $course_id,
            'user_id' => $model->getAttribute('user_id')
        ])->first();

        $countLessons = $course->singleCourse->lessons->count();
        $countPassed = LessonUser::query()->whereIn('lesson_id', $course->singleCourse->lessons->pluck('id'))
            ->where([
                'user_id' => $model->getAttribute('user_id'),
                'is_passed' => true
            ])->count();

        $course->update(['percentage_passing' => (int)(($countPassed / $countLessons) * 100)]);

    }

}
