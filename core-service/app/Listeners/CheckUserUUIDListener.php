<?php

namespace App\Listeners;

use App\Exceptions\UUIDException;
use App\Helpers\AbstractListener;
use App\Helpers\AbstractServiceEvent;

class CheckUserUUIDListener extends AbstractListener
{
    /**
     * @throws UUIDException
     */
    public function handle(AbstractServiceEvent $event): void
    {
        parent::handle($event);
        $model = $event->getModel();

        if ($model->getAttribute('user_id') !== $event->getUuid()) {
            throw new UUIDException();
        }
    }
}
