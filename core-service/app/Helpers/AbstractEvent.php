<?php

namespace App\Helpers;

use Egal\Core\Events\Event;
use Egal\Model\Model;


abstract class AbstractEvent extends Event
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }
}
