<?php

namespace App\Listeners;

use App\Events\CreateUserEvent as CreateUserEvent;
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
     */
    public function handle(CreateUserEvent $event): void
    {
        print_r($event->user->id);
        var_dump($event->user->first_name);
        var_dump($event->user->last_name);
        var_dump($event->user->phone);
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
        $request->call();
        $response = $request->getResponse();
        var_dump($response);
        if ($response->getStatusCode() != 200) {
            $actionErrorMessage = $response->getActionErrorMessage(); // Получение сообщения ошибки
        } else {
            $actionResultMessage = $response->getActionResultMessage(); // Получение сообщения результата выполнения [действия](/_glossary?id=действия) }
        }

        $event->user->offsetUnset('phone');
        $event->user->offsetUnset('first_name');
        $event->user->offsetUnset('last_name');
    }

}
