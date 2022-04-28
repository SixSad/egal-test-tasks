<?php

namespace App\Exceptions;

use Exception;

class UUIDException extends Exception
{

    protected $message = 'Invalid user_id';

    protected $code = 400;
}
