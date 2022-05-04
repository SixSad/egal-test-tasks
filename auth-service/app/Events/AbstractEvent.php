<?php

namespace App\Events;

use Egal\Core\Events\Event;
use Egal\Model\Model;
use Illuminate\Support\Facades\Log;

abstract class AbstractEvent extends Event
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->setModel($model);
        Log::info(sprintf("Event [%s] was fired with model [%s]. (%s). %s",
            get_class($this),
            get_class($model),
            $model->wasChanged() ? "Changes: true" : ($model->isDirty() ? "Dirty: true" : "Dirty: false"),
            $model->getAttributes() ? "Serialized model: $model" : "",
        ));
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
