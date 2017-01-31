<?php

namespace tochkaDevelopers\laravelStompQueue;

use Illuminate\Support\ServiceProvider;
use tochkaDevelopers\laravelStompQueue\Connectors\StompConnector;

class StompServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app['queue']->addConnector('stomp', function () {
            return new StompConnector();
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}