<?php namespace Arcanedev\Notify;

use Arcanedev\Notify\Storage\Session;
use Arcanedev\Support\PackageServiceProvider as ServiceProvider;

/**
 * Class     NotifyServiceProvider
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyServiceProvider extends ServiceProvider
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
        $this->registerConfig();

        $this->bind(
            Contracts\SessionStoreInterface::class,
            Session::class
        );

        $this->singleton('arcanedev.notify', function ($app) {
            /**
             * @var \Illuminate\Foundation\Application  $app
             * @var \Illuminate\Config\Repository       $config
             */
            $session = $app[Contracts\SessionStoreInterface::class];
            $config  = $app['config'];

            return new Notify(
                $session,
                $config->get('notify.session.prefix', 'notifier.')
            );
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
