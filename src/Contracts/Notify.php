<?php namespace Arcanedev\Notify\Contracts;

/**
 * Interface  Notify
 *
 * @package   Arcanedev\Notify\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Notify
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the notification message.
     *
     * @return string
     */
    public function message();

    /**
     * Get the notification type.
     *
     * @return string
     */
    public function type();

    /**
     * Get an additional stored options.
     *
     * @param  boolean  $assoc
     *
     * @return mixed
     */
    public function options($assoc = false);

    /**
     * Get a notification option.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function option($key, $default = null);

    /**
     * Check if the flash notification has an option.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function hasOption($key);

    /**
     * If the notification is ready to be shown.
     *
     * @return bool
     */
    public function ready();

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Flash a message.
     *
     * @param  string  $message
     * @param  string  $type
     * @param  array   $options
     *
     * @return self
     */
    public function flash($message, $type = null, array $options = []);
}
