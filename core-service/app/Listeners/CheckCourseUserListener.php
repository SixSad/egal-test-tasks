<?php

namespace App\Listeners;

use App\Events\CreateCourseUserEvent;
use Egal\Core\Session\Session;

class CheckCourseUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle(CreateCourseUserEvent $event): void
    {
        var_dump($event);
        if(Session::getUserServiceToken()->getUid()){
            var_dump(Session::getUserServiceToken()->getUid());
        }
    }

}
