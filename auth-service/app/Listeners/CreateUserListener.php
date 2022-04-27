<?php

namespace App\Listeners;

use App\Events\CreateUserEvent as CreateUserEvent;
use App\Helpers\AuthValidator;
use Egal\Core\Exceptions\ActionCallException;
use Egal\Model\Exceptions\ValidateException;
use Exception;
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
        $attributes = $event->getAttributes();
        $model = $event->getModel();
        $model->setAttribute('id', Str::uuid());

        AuthValidator::validate($attributes, [
            'phone' => 'required|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

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

        $request->call();
        $response = $request->getResponse();

        if ($response->getStatusCode() != 200) {
            $actionErrorMessage = $response->getActionErrorMessage()->getMessage();
            $actionErrorCode = $response->getActionErrorMessage()->getCode();
            throw new Exception($actionErrorMessage, $actionErrorCode);
        }
    }
}
