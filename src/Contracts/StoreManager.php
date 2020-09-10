<?php

declare(strict_types=1);

namespace Arcanedev\Notify\Contracts;

/**
 * Interface  StoreManager
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface StoreManager
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
    public function getDefaultDriver(): string;

    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     *
     * @return mixed
     */
    public function driver($driver = null);

    /**
     * Register multiple store.
     *
     * @param  array  $stores
     *
     * @return $this
     */
    public function registerStores(array $stores): self;

    /**
     * Register a store.
     *
     * @param  string  $driver
     * @param  array   $store
     *
     * @return $this
     */
    public function registerStore(string $driver, array $store): self;
}
