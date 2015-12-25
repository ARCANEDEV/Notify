<?php namespace Arcanedev\Notify\Storage;

use Arcanedev\Notify\Contracts\SessionStore;
use Illuminate\Session\Store as IlluminateSession;

/**
 * Class     Session
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Session implements SessionStore
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The Illuminate Session instance.
     *
     * @var \Illuminate\Session\Store
     */
    private $session;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make session store instance.
     *
     * @param  \Illuminate\Session\Store  $session
     */
    public function __construct(IlluminateSession $session)
    {
        $this->session = $session;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Flash a message to the session.
     *
     * @param  string|array  $key
     * @param  mixed         $value
     */
    public function flash($key, $value = null)
    {
        if (is_array($key)) {
            $this->flashMany($key);

            return;
        }

        $this->session->flash($key, $value);
    }

    /**
     * Flash multiple key/value pairs.
     *
     * @param  array  $data
     */
    public function flashMany($data)
    {
        foreach ($data as $key => $value) {
            $this->flash($key, $value);
        }
    }

    /**
     * Get a value from session storage.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->session->get($key);
    }
}
