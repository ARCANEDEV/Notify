<?php namespace Arcanedev\Notify;

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
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->bindSession();
        $this->registerNotifyService();
    }

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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['arcanedev.notify'];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Services
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Bind the Session Class.
     */
    private function bindSession()
    {
        $this->bind(
            \Arcanedev\Notify\Contracts\SessionStore::class,
            \Arcanedev\Notify\Storage\Session::class
        );
    }

    /**
     * Register the Notify service.
     */
    private function registerNotifyService()
    {
        $this->singleton('arcanedev.notify', function ($app) {
            /**  @var \Illuminate\Config\Repository  $config  */
            $config  = $app['config'];

            return new Notify(
                $app[\Arcanedev\Notify\Contracts\SessionStore::class],
                $config->get('notify.session.prefix', 'notifier.')
            );
        });
    }
}
