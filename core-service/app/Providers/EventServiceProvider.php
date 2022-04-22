<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CourseUserCreatingEvent;
use App\Events\CreateCourseUserEvent;
use App\Listeners\CheckCourseUserListener;
use App\Listeners\CheckFreePlacesListener;
use App\Listeners\CheckUserUidListener;
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

                ]
            ]
        ]
    ];

    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        CreateCourseUserEvent::class => [
            CheckCourseUserListener::class,
            CheckFreePlacesListener::class
        ]
    ];

}
