<?php

namespace App\Listeners;

use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\Lesson;
use App\Models\LessonUser;

class CreateLessonUserListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();
        $attributes = $model->getAttributes();
        $lessons = Lesson::query()->where('course_id', $attributes['course_id'])->get();

        foreach ($lessons as $lesson) {
            LessonUser::query()->create([
                'user_id' => $attributes['user_id'],
                'lesson_id' => $lesson->id,
                'is_passed' => 0
            ]);
        }
    }

}
