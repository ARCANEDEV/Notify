<?php

declare(strict_types=1);

namespace Arcanedev\Notify;

use Arcanedev\Notify\Contracts\StoreManager as StoreManagerContract;
use Arcanedev\Support\Providers\PackageServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     NotifyServiceProvider
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyServiceProvider extends PackageServiceProvider implements DeferrableProvider
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->registerConfig();

        // Store Manager
        $this->singleton(StoreManagerContract::class, StoreManager::class);

        $this->app->resolving(StoreManagerContract::class, function (StoreManagerContract $manager, $app) {
            $stores = $app['config']->get('notify.stores', []);

            return $manager->registerStores($stores);
        });

        // Store driver
        $this->bind(Contracts\Store::class, function ($app) {
            return $app[StoreManagerContract::class]->driver();
        });

        // Notifier
        $this->singleton(Contracts\Notify::class, Notify::class);
    }

    /**
     * Boot the package.
     */
    public function boot(): void
    {
        $this->publishConfig();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Contracts\Notify::class,
            Contracts\Store::class,
        ];
    }
}
