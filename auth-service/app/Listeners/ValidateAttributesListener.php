<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Sixsad\Helpers\ServiceValidator;

class ValidateAttributesListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $attributes = $event->getAttributes();
        $model = $event->getModel();

        ServiceValidator::validate($attributes, [
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:5|max:60',
            'phone' => 'required|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        $model->setAttribute('email', $attributes['email']);
        $model->setAttribute('password', $attributes['password']);

    }
}
