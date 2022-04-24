<?php

namespace App\Listeners;

use App\Events\CourseUserCreatedEvent;
use App\Models\Lesson;
use App\Models\LessonUser;


class CreateLessonUserListener
{

    public function handle(CourseUserCreatedEvent $event): void
    {
        $model = $event->getModel();
        $attributes = $model->getAttributes();
        $lessons = Lesson::query()->where('course_id',$attributes['course_id'])->get();

        foreach ($lessons as $lesson) {
            LessonUser::query()->create([
                'user_id' => $attributes['user_id'],
                'lesson_id' => $lesson->id,
                'is_passed' => 0
            ]);
        }
    }

}
