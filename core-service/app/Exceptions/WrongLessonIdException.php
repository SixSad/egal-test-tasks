<?php

namespace App\Exceptions;

use Exception;

class WrongLessonIdException extends Exception
{

    protected $message = 'You are not enrolled in this lesson';

    protected $code = 400;
}
