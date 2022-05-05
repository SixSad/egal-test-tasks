<?php

namespace App\Rules;

use App\Models\User;
use Egal\Validation\Rules\Rule as EgalRule;

class CheckEmailRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $user = User::query()->where('email', $value)->first();
        return (bool)$user;
    }

    public function message(): string
    {
        return ('Incorrect Email');
    }

}
