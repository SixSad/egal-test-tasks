<?php

namespace App\Helpers;

use Egal\Core\Session\Session;

class SessionAttributes
{
    public static function getAttributes(): array
    {
        return Session::getActionMessage()->getParameters()['attributes'] ?? [];
    }
}
