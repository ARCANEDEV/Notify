<?php namespace Arcanedev\Notify;

use Arcanedev\Support\PackageServiceProvider;

/**
 * Class     NotifyServiceProvider
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor   = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package  = 'notify';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Boot the package.
     */
    public function boot()
    {
        parent::boot();

        $viewPath = $this->getBasePath() . '/resources/views';

        $this->loadViewsFrom($viewPath, $this->package);
        $this->publishes([
            $viewPath => base_path('resources/views/vendor/' . $this->package),
        ], 'views');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->bind(
            Contracts\SessionStoreContract::class,
            SessionStore::class
        );

        $this->singleton('arcanedev.notify', function ($app) {
            /** @var \Illuminate\Foundation\Application $app */
            $session = $app[Contracts\SessionStoreContract::class];

            return new Notify($session);
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
