<?php namespace Arcanedev\Notify\Contracts;

/**
 * Interface SessionStoreContract
 * @package Arcanedev\Notify\Contracts
 */
interface SessionStoreContract
{
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
    public function flash($name, $data);
}
