<?php namespace Arcanedev\Notify;

use Illuminate\Support\Manager;
use Arcanedev\Notify\Contracts\StoreManager as StoreManagerContract;

/**
 * Class     StoreManager
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StoreManager extends Manager implements StoreManagerContract
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
    public function getDefaultDriver(): string
    {
        return $this->config->get('notify.default', 'session');
    }

    /**
     * Register multiple stores.
     *
     * @param  array  $stores
     *
     * @return $this
     */
    public function registerStores(array $stores): StoreManagerContract
    {
        foreach ($stores as $driver => $store) {
            $this->registerStore($driver, $store);
        }

        return $this;
    }

    /**
     * Register a store.
     *
     * @param  string  $driver
     * @param  array   $store
     *
     * @return self
     */
    public function registerStore(string $driver, array $store): StoreManagerContract
    {
        return $this->extend($driver, function () use ($store) {
            return $this->container->make($store['class'], [
                'options' => $store['options'] ?? [],
            ]);
        });
    }
}
