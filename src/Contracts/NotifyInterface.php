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
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Flash an information message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function info($message);

    /**
     * Flash a success message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function success($message);

    /**
     * Flash an error message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function error($message);

    /**
     * Flash a warning message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function warning($message);

    /**
     * Flash an overlay modal.
     *
     * @param  string  $message
     * @param  string  $title
     *
     * @return self
     */
    public function overlay($message, $title = 'Notice');

    /**
     * Add an "important" flash to the session.
     *
     * @return self
     */
    public function important();
}
