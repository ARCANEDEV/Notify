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
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Session prefix name.
     *
     * @var string
     */
    protected $sessionPrefix = '';

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
     * @param  string                $prefix
     */
    public function __construct(SessionStoreContract $session, $prefix)
    {
        $this->session       = $session;
        $this->sessionPrefix = $prefix;
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
        $this->flashMany([
            'message' => $message,
            'level'   => 'info',
        ]);

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
        $this->flashMany([
            'message' => $message,
            'level'   => 'success',
        ]);
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
        $this->flashMany([
            'message' => $message,
            'level'   => 'danger',
        ]);

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
        $this->flashMany([
            'message' => $message,
            'level'   => 'warning',
        ]);

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
        return $this->flashMany([
            'message' => $message,
            'level'   => 'info',
            'overlay' => true,
            'title'   => $title,
        ]);
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return self
     */
    public function important()
    {
        return $this->flash('important', true);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Flash the notification.
     *
     * @param  string  $name
     * @param  mixed   $value
     *
     * @return self
     */
    private function flash($name, $value)
    {
        $this->session->flash($this->sessionPrefix . $name, $value);

        return $this;
    }

    /**
     * Flash the notification with many values
     *
     * @param  array  $data
     *
     * @return self
     */
    private function flashMany(array $data)
    {
        $prefixed = [];

        foreach ($data as $key => $value) {
            $prefixed[$this->sessionPrefix . $key] = $value;
        }

        $this->session->flashMany($prefixed);

        return $this;
    }
}
