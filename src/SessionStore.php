<?php namespace Arcanedev\Notify;

use Arcanedev\Notify\Contracts\SessionStoreContract;
use Illuminate\Session\Store as Session;

/**
 * Class     SessionStore
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionStore implements SessionStoreContract
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
     * @param Session $session
     */
    public function __construct(Session $session)
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
    public function flash($name, $data)
    {
        $this->session->flash($name, $data);
    }
}
