<?php namespace Arcanedev\Notify\Laravel;

use Arcanedev\Notify\Contracts\SessionStoreContract;
use Illuminate\Session\Store;

/**
 * Class SessionStore
 * @package Arcanedev\Notify\Laravel
 */
class SessionStore implements SessionStoreContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Store */
    private $session;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param Store $session
     */
    function __construct(Store $session)
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
     * @param string $name
     * @param mixed  $data
     */
    public function flash($name, $data)
    {
        $this->session->flash($name, $data);
    }
}
