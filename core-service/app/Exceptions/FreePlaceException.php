<?php

namespace App\Exceptions;

use Exception;

class FreePlaceException extends Exception
{

    protected $message = 'There are no places to record';

    protected $code = 400;
}
