<?php

namespace App\Listeners;

use App\Events\CourseUserCreatingEvent;

use Egal\Core\Listeners\EventListener;

class CheckUserUUIDListener extends EventListener
{

    public function __construct(CourseUserCreatingEvent $event)
    {
        print_r($event->courseUser->getAttributes());
    }

    public function handle(): void
    {

    }

}
