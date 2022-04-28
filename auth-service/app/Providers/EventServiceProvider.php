<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CreateUserEvent;
use App\Listeners\CreateUserListener;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;
use Egal\Core\Events\UserServiceTokenDetectedEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        CreateUserEvent::class => [
            CreateUserListener::class
        ],
    ];

}
