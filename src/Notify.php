<?php namespace Arcanedev\Notify;

use Arcanedev\Notify\Contracts\SessionStoreContract;

class Notify
{
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

    const SESSION_NAME = 'notifyer';

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new flash notifier instance.
     *
     * @param SessionStoreContract $session
     */
    function __construct(SessionStoreContract $session)
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
     * @param  string $message
     *
     * @return Notify
     */
    public function info($message)
    {
        $this->message($message, 'info');

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string $message
     *
     * @return Notify
     */
    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string $message
     *
     * @return Notify
     */
    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string $message
     *
     * @return Notify
     */
    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     *
     * @return Notify
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
     * @param  string $message
     * @param  string $title
     *
     * @return Notify
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info', $title);
        $this->session->flash(self::SESSION_NAME . '.overlay', true);
        $this->session->flash(self::SESSION_NAME . '.title', $title);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return Notify
     */
    public function important()
    {
        $this->session->flash(self::SESSION_NAME . '.important', true);

        return $this;
    }
}
