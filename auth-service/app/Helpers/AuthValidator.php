<?php

namespace App\Helpers;

use Egal\Model\Exceptions\ValidateException;
use Illuminate\Support\Facades\Validator;

class AuthValidator
{

    public static function validate(array $attributes, array $rules): void
    {
        $validator = Validator::make($attributes, $rules);

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());

            throw $exception;
        }
    }

    public static function validateFirstFail(array $attributes, array $rules): void
    {
        $validator = Validator::make($attributes, $rules)->stopOnFirstFailure();

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());

            throw $exception;
        }
    }

}
