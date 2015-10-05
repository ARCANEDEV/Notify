<?php namespace Arcanedev\Notify\Contracts;

/**
 * Interface  SessionStoreContract
 *
 * @package   Arcanedev\Notify\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
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
     * @param  string  $key
     * @param  mixed   $value
     */
    public function flash($key, $value);

    /**
     * Flash multiple key/value pairs.
     *
     * @param  array  $data
     */
    public function flashMany($data);
}
