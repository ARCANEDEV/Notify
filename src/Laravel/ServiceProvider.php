<?php namespace Arcanedev\Notify\Laravel;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 * @package Arcanedev\Notify\Laravel
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->package('arcanedev/notify', null, realpath(__DIR__ . '/../..'));
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(
            'Arcanedev\\Notify\\Contracts\\SessionStoreContract',
            'Arcanedev\\Notify\\Laravel\\SessionStore'
        );

        $this->app->bindShared('arcanedev.notify', function () {
            return $this->app->make('Arcanedev\\Notify\\Notify');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['arcanedev.notify'];
    }
}
