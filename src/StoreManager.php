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
        return $this->config()->get('notify.default', 'session');
    }

    /**
     * Load the stores.
     *
     * @return void
     */
    public function loadStores(): void
    {
        foreach ($this->config()->get('notify.stores', []) as $driver => $store) {
            $this->loadStore($driver, $store);
        }
    }

    /**
     * Load/Register a store.
     *
     * @param  string  $driver
     * @param  array   $store
     *
     * @return void
     */
    protected function loadStore(string $driver, array $store)
    {
        $class = $store['class'];

        $this->extend($driver, function () use ($class) {
            return $this->app->make($class);
        });

        $this->app->when($class)->needs('$options')->give(function () use ($store) {
            return $store['options'] ?? [];
        });
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
