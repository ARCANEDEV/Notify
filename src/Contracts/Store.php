<?php

declare(strict_types=1);

namespace Arcanedev\Notify\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface  Store
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Store
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the notifications.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection;

    /**
     * Push the new notification.
     *
     * @param  array  $notification
     */
    public function push(array $notification);

    /**
     * Forget the notifications.
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
