<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CreateUserEvent;
use App\Listeners\CreateUserListener;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Определение обработчиков глобальных событий
     */
    public array $globalListen = [
        'service' => [
            'Model' => [
                'event-message' => [
                    ExampleListener::class
                ]
            ]
        ]
    ];

    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        CreateUserEvent::class => [
            CreateUserListener::class
        ]
    ];

}
