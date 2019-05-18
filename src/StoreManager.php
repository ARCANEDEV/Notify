<?php namespace Arcanedev\Notify;

use Illuminate\Support\Manager;

/**
 * Class     StoreManager
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StoreManager extends Manager
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('notify.default', 'session');
    }

    /**
     * Load the stores.
     *
     * @return void
     */
    public function loadStores(): void
    {
        $stores = $this->config()->get('notify.stores', []);

        foreach ($stores as $driver => $store) {
            $this->extend($driver, function () use ($store) {
                return $this->app->make($store['driver']);
            });

            $this->app->when($store['driver'])
                      ->needs('$options')
                      ->give($store['options'] ?? []);
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the config repository.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    protected function config()
    {
        return $this->app['config'];
    }
}
