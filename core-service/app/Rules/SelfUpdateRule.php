<?php

namespace App\Rules;

use App\Models\LessonUser;
use Egal\Core\Session\Session;
use Egal\Validation\Rules\Rule as EgalRule;

class SelfUpdateRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
//        var_dump('asdasd');
//        $uuid = Session::getUserServiceToken()->getUid();
//        $lesson = LessonUser::query()->where([
//            'lesson_id' => $value,
//            "user_id" => $uuid,
//        ])->first();
//
//        if ($lesson) {
//            return false;
//        }
//
//        return true;
        return false;
    }

    public function message(): string
    {
        return parent::message(); // TODO
    }

}
