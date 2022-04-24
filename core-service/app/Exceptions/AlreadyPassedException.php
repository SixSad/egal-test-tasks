<?php

namespace App\Exceptions;

use Exception;

class AlreadyPassedException extends Exception
{

    protected $message = 'You have already completed the lesson';

    protected $code = 400;
}
