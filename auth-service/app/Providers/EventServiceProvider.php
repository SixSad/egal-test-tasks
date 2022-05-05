<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CreateUserEvent;
use App\Listeners\CreatingUserRequestListener;
use App\Listeners\ValidateAttributesListener;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        CreateUserEvent::class => [
            ValidateAttributesListener::class,
            CreatingUserRequestListener::class
        ]
    ];
}
