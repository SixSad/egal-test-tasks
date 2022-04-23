<?php

namespace App\Listeners;

use App\Events\CreateUserEvent as CreateUserEvent;
use Egal\Core\Listeners\EventListener;
use Egal\Model\Exceptions\ValidateException;
use Illuminate\Support\Facades\Validator;


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
     */
    public function handle(CreateUserEvent $event): void
    {
        $validator = Validator::make($event->user->getAttributes(), [
            'phone' => 'required|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());

            throw $exception;
        }

        $request = new \Egal\Core\Communication\Request(
            'core',
            'User',
            'create',
            [
                'attributes' => [
                    'id' => $event->user->id,
                    'phone' => $event->user->phone,
                    'first_name' => $event->user->first_name,
                    'last_name' => $event->user->last_name
                ]]
        );
        $request->send();

        $event->user->offsetUnset('phone');
        $event->user->offsetUnset('first_name');
        $event->user->offsetUnset('last_name');
    }
}
