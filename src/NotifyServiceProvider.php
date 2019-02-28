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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'notify';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

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

        $this->publishConfig();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Contracts\Notify::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Services
     | -----------------------------------------------------------------
     */

    /**
     * Bind the Session Class.
     */
    private function bindSession()
    {
        $this->bind(Contracts\SessionStore::class, Storage\Session::class);
    }

    /**
     * Register the Notify service.
     */
    private function registerNotifyService()
    {
        $this->singleton(Contracts\Notify::class, function ($app) {
            /**  @var \Illuminate\Config\Repository  $config  */
            $config = $app['config'];

            return new Notify(
                $app[Contracts\SessionStore::class],
                $config->get('notify.session.prefix', 'notifier')
            );
        });
    }
}
