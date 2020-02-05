<?php

declare(strict_types=1);

namespace Arcanedev\Notify\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface  Notify
 *
 * @package   Arcanedev\Notify\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Notify
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the store.
     *
     * @return \Arcanedev\Notify\Contracts\Store
     */
    public function store(): Store;

    /**
     * Set the store.
     *
     * @param  \Arcanedev\Notify\Contracts\Store  $store
     *
     * @return $this
     */
    public function setStore(Store $store);

    /**
     * Get all the notifications.
     *
     * @return \Illuminate\Support\Collection
     */
    public function notifications(): Collection;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Flash an information message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function info(string $message, array $extra = []);

    /**
     * Flash a success message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function success(string $message, array $extra = []);

    /**
     * Flash an error message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function error(string $message, array $extra = []);

    /**
     * Flash a warning message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function warning(string $message, array $extra = []);

    /**
     * Flash a new notification.
     *
     * @param  string       $message
     * @param  string|null  $type
     * @param  array        $extra
     *
     * @return $this
     */
    public function flash($message, $type = 'info', array $extra = []);

    /**
     * Forget the notification.
     *
     * @return void
     */
    public function forget();

    /**
     * Check if it has notifications.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Check if there is no notifications.
     *
     * @return bool
     */
    public function isNotEmpty(): bool;
}
