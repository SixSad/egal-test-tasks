<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CourseUserCreatingEvent;
use App\Listeners\CheckUserUUIDListener;
use App\Listeners\CourseFreePlacesListener;
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
        CourseUserCreatingEvent::class => [
            CheckUserUUIDListener::class,
            CourseFreePlacesListener::class,
        ]
    ];

}
