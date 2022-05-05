<?php

namespace App\Rules;

use App\Models\CourseUser;
use Egal\Core\Session\Session;
use Egal\Validation\Rules\Rule as EgalRule;

class UniqueCourseUserRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $uuid = Session::getUserServiceToken()->getUid();
        $course = CourseUser::query()->where([
            "user_id" => $uuid,
            "course_id" => $value,
        ])->exists();

        return !$course;
    }

    public function message(): string
    {
        return ("You already enroll");
    }

}
