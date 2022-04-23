<?php

namespace App\Exceptions;

use Exception;

class UUIDException extends Exception
{

    protected $message = 'Wrong Id';

    protected $code = 400;
}
