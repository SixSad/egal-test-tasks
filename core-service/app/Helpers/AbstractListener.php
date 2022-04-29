<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

abstract class AbstractListener
{
    public function handle(AbstractServiceEvent $event): void
    {
        Log::info('Listener: ' . get_class($this) . '. Event: ' . get_class($event));
    }
}