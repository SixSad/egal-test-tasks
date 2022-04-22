<?php

namespace App\Listeners;

use App\Events\CreateCourseUserEvent;


class CheckFreePlacesListener
{

    public function handle(CreateCourseUserEvent $event): void
    {
        var_dump('asd');
    }

}
