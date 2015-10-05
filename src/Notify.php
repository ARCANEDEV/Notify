<?php namespace Arcanedev\Notify;

use Arcanedev\Notify\Contracts\NotifyInterface;
use Arcanedev\Notify\Contracts\SessionStoreContract;

/**
 * Class     Notify
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Notify implements NotifyInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const SESSION_NAME = 'notifier';

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The session writer.
     *
     * @var SessionStoreContract
     */
    private $session;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new flash notifier instance.
     *
     * @param  SessionStoreContract  $session
     */
    public function __construct(SessionStoreContract $session)
    {
        $this->session = $session;
    }

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
    public function info($message)
    {
        $this->message($message, 'info');

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string  $message
     *
     * @return self
     */
    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string  $message
     * @param  string  $level
     *
     * @return self
     */
    public function message($message, $level = 'info')
    {
        $this->session->flash(self::SESSION_NAME . '.message', $message);
        $this->session->flash(self::SESSION_NAME . '.level', $level);

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string  $message
     * @param  string  $title
     *
     * @return self
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info');
        $this->session->flash(self::SESSION_NAME . '.overlay', true);
        $this->session->flash(self::SESSION_NAME . '.title', $title);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return self
     */
    public function important()
    {
        $this->session->flash(self::SESSION_NAME . '.important', true);

        return $this;
    }
}
