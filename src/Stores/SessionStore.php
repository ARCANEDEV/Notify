<?php

declare(strict_types=1);

namespace Arcanedev\Notify\Stores;

use Arcanedev\Notify\Contracts\Store;
use Illuminate\Contracts\Session\Session as SessionContract;
use Illuminate\Support\Collection;

/**
 * Class     Session
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionStore implements Store
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The Illuminate Session instance.
     *
     * @var \Illuminate\Contracts\Session\Session
     */
    private $session;

    /**
     * The store's options.
     *
     * @var array
     */
    protected $options;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make session store instance.
     *
     * @param  \Illuminate\Contracts\Session\Session  $session
     * @param  array                                  $options
     */
    public function __construct(SessionContract $session, array $options)
    {
        $this->session = $session;
        $this->options = $options;
    }

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the session key.
     *
     * @return string
     */
    protected function getSessionKey(): string
    {
        return $this->options['key'];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the notifications.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return new Collection(
            $this->session->get($this->getSessionKey(), [])
        );
    }

    /**
     * Push the new notification.
     *
     * @param  array  $notification
     */
    public function push(array $notification)
    {
        $this->session->flash(
            $this->getSessionKey(),
            $this->all()->push($notification)
        );
    }

    /**
     * Forget the notifications.
     */
    public function forget(): void
    {
        $this->session->forget($this->getSessionKey());
    }

    /**
     * Check if it has notifications.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->all()->isEmpty();
    }

    /**
     * Check if there is no notifications.
     *
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }
}
