<?php namespace Arcanedev\Notify\Storage;

use Arcanedev\Notify\Contracts\SessionStore;
use Illuminate\Contracts\Session\Session as SessionContract;

/**
 * Class     Session
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Session implements SessionStore
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

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make session store instance.
     *
     * @param  \Illuminate\Contracts\Session\Session  $session
     */
    public function __construct(SessionContract $session)
    {
        $this->session = $session;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Flash a message to the session.
     *
     * @param  string|array  $key
     * @param  mixed         $value
     */
    public function flash($key, $value = null)
    {
        if (is_array($key))
            $this->flashMany($key);
        else
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
