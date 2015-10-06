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
     * @param  string|array  $key
     * @param  mixed         $value
     */
    public function flash($key, $value = null);

    /**
     * Flash multiple key/value pairs.
     *
     * @param  array  $data
     */
    public function flashMany($data);

    /**
     * Get a value from session storage.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function get($key);
}
