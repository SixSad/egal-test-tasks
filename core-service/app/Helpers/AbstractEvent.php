<?php

namespace App\Helpers;

use Egal\Core\Events\Event;
use Egal\Core\Session\Session;
use Egal\Model\Model;
use Illuminate\Support\Facades\Log;


abstract class AbstractEvent extends Event
{
    private Model $model;
    private string $uuid;

    public function __construct(Model $model)
    {
        Log::info(
            'Event ' . get_class($this)
            . ' was fired with model: '
            . get_class($model)
            . '(Changes: ' . $model->wasChanged()
            . ', Dirty: ' . $model->isDirty()
            . ") \nSerialized model: "
            , [$model->toArray()]
        );
        $this->setModel($model);
        $this->setUuid();
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function setUuid()
    {
        $this->uuid = Session::getUserServiceToken()->getUid();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
