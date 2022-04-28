<?php

namespace App\Listeners;

use App\Exceptions\UUIDException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;

class CheckUserUUIDListener extends AbstractListener
{
    /**
     * @throws UUIDException
     */
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();
        $uuid = $event->getUuid();

        if ($model->getAttribute('user_id') !== $uuid) {
            throw new UUIDException();
        }
    }
}
