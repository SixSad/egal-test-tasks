<?php

namespace App\Exceptions;

use Exception;

class WrongAttibuteException extends Exception
{

    protected $message = 'Only is_passed can be updated';

    protected $code = 400;
}
