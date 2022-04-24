<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;


class CalculatingPassingPercentageListener
{

    public function handle(UpdatedLessonUserEvent $event): void
    {

    }

}
