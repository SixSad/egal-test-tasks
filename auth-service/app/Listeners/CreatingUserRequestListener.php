<?php

namespace App\Listeners;

use App\Events\CreateUserEvent as CreateUserEvent;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use Egal\Model\Exceptions\ValidateException;
use Exception;
use Illuminate\Support\Str;

class CreatingUserRequestListener extends AbstractListener
{
    /**
     * Handle the event.
     *
     * @param CreateUserEvent $event
     * @return void
     * @throws ValidateException|Exception
     */
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $attributes = $event->getAttributes();
        $model = $event->getModel();
        $model->setAttribute('id', Str::uuid());

        $request = new \Egal\Core\Communication\Request(
            'core',
            'User',
            'create',
            [
                'attributes' => [
                    'id' => $model->id,
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
