<?php namespace Arcanedev\Notify\Contracts;

/**
 * Interface  NotifyInterface
 *
 * @package   Arcanedev\Notify\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface NotifyInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
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
     * If the notification is ready to be shown.
     *
     * @return bool
     */
    public function ready();

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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
