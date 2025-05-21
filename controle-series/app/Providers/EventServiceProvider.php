<?php

namespace App\Providers;

use App\Events\SeriesCreated;
use App\Listeners\EmailUsersAboutSeriesCreated;
use App\Listeners\LogSeriesCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
   /**
     * O array de eventos para o qual os listeners estão registrados.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class
        ],
        SeriesCreated::class => [
            EmailUsersAboutSeriesCreated::class,
            LogSeriesCreated::class
        ]
    ];

    /**
     * Registre quaisquer eventos para o seu aplicativo.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine se os eventos e ouvintes devem ser automaticamente descobertos.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

    /**
     * Obtenha os diretórios que devem ser verificados para eventos e ouvintes.
     *
     * @return array<int, string>
     */
    protected function discoverEventsWithin()
    {
        return [
            app_path('Listeners'),
        ];
    }
}
