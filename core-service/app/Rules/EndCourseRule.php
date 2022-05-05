<?php

namespace App\Rules;

use App\Models\Course;
use App\Models\Lesson;
use Carbon\Carbon;
use Egal\Validation\Rules\Rule as EgalRule;

class EndCourseRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $lesson = Lesson::query()->findOrFail($value);
        $course = Course::query()->findOrFail($lesson['course_id']);
        return Carbon::parse($course['end_date'])->getTimestamp() > Carbon::now()->getTimestamp();
    }

    public function message(): string
    {
        return "Course dried up";
    }

}
