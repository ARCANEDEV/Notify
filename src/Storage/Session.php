<?php namespace Arcanedev\Notify\Storage;

use Arcanedev\Notify\Contracts\SessionStoreContract;
use Illuminate\Session\Store as IlluminateSession;

/**
 * Class     Session
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Session implements SessionStoreContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Session */
    private $session;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make session store instance.
     *
     * @param  IlluminateSession  $session
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
     * @param  string  $name
     * @param  mixed   $data
     */
    public function flash($name, $data = null)
    {
        if (is_array($name)) {
            $this->flashMany($name);

            return;
        }

        $this->session->flash($name, $data);
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
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->session->get($key);
    }
}
