<?php

declare(strict_types=1);

namespace Arcanedev\Notify;

use Arcanedev\Notify\Contracts\Notify as NotifyContract;
use Arcanedev\Notify\Contracts\Store as StoreContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

/**
 * Class     Notify
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Notify implements NotifyContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Macroable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The session writer.
     *
     * @var \Arcanedev\Notify\Contracts\Store
     */
    private $store;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new flash notifier instance.
     *
     * @param  \Arcanedev\Notify\Contracts\Store  $store
     */
    public function __construct(StoreContract $store)
    {
        $this->setStore($store);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the store.
     *
     * @return \Arcanedev\Notify\Contracts\Store
     */
    public function store(): StoreContract
    {
        return $this->store;
    }

    /**
     * Set the store.
     *
     * @param  \Arcanedev\Notify\Contracts\Store  $store
     *
     * @return $this
     */
    public function setStore(StoreContract $store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get all the notifications.
     *
     * @return \Illuminate\Support\Collection
     */
    public function notifications(): Collection
    {
        return $this->store()->all();
    }

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
    public function info(string $message, array $extra = [])
    {
        return $this->flash($message, 'info', $extra);
    }

    /**
     * Flash a success message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function success(string $message, array $extra = [])
    {
        return $this->flash($message, 'success', $extra);
    }

    /**
     * Flash an error message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function error(string $message, array $extra = [])
    {
        return $this->flash($message, 'danger', $extra);
    }

    /**
     * Flash a warning message.
     *
     * @param  string  $message
     * @param  array   $extra
     *
     * @return $this
     */
    public function warning(string $message, array $extra = [])
    {
        return $this->flash($message, 'warning', $extra);
    }

    /**
     * Flash a new notification.
     *
     * @param  string       $message
     * @param  string|null  $type
     * @param  array        $extra
     *
     * @return $this
     */
    public function flash($message, $type = 'info', array $extra = [])
    {
        $this->store()->push(compact('message', 'type', 'extra'));

        return $this;
    }

    /**
     * Forget the notification.
     */
    public function forget(): void
    {
        $this->store->forget();
    }

    /**
     * Check if it has notifications.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->store()->isEmpty();
    }

    /**
     * Check if there is no notifications.
     *
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return $this->store()->isNotEmpty();
    }
}
