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

        $this->singleton(StoreManager::class, function ($app) {
            return tap(new StoreManager($app), function (StoreManager $manager) {
                $manager->loadStores();
            });
        });

        $this->bind(Contracts\Store::class, function ($app) {
            return $app[StoreManager::class]->driver();
        });

        $this->singleton(Contracts\Notify::class, Notify::class);
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
}
