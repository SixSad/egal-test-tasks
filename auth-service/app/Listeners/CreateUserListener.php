<?php

namespace App\Listeners;

use App\Events\CreateUserEvent as CreateUserEvent;
use App\Helpers\AuthValidator;
use Egal\Core\Session\Session;
use Egal\Model\Exceptions\ValidateException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CreateUserListener
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

    /**
     * Handle the event.
     *
     * @param CreateUserEvent $event
     * @return void
     * @throws ValidateException
     */
    public function handle(CreateUserEvent $event): void
    {
        $attributes = Session::getActionMessage()->getParameters()['attributes'];
        $model = $event->getModel();
        $model->setAttribute('id', Str::uuid());

        $validator = new AuthValidator($attributes, [
            'phone' => 'required|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        $validator->validate();

        $request = new \Egal\Core\Communication\Request(
            'core',
            'User',
            'create',
            [
                'attributes' => [
                    'id' => $event->user->id,
                    'phone' => $attributes['phone'],
                    'first_name' => $attributes['first_name'],
                    'last_name' => $attributes['last_name']
                ]]
        );

        $request->send();
    }
}
