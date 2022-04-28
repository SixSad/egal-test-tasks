<?php

namespace App\Helpers;

abstract class AbstractListener
{
    public function handle(AbstractEvent $event): void
    {

    }
}
