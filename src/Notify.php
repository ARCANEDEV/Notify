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
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the notification message.
     *
     * @return string
     */
    public function message()
    {
        return $this->getSession('message');
    }

    /**
     * Get the notification type.
     *
     * @return string
     */
    public function type()
    {
        return $this->getSession('type');
    }

    /**
     * Get an additional stored options.
     *
     * @param  boolean  $assoc
     *
     * @return mixed
     */
    public function options($assoc = false)
    {
        return json_decode($this->getSession('options'), $assoc);
    }

    /**
     * Get a notification option.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function option($key, $default = null)
    {
        return array_get($this->options(true), $key, $default);
    }

    /**
     * If the notification is ready to be shown.
     *
     * @return bool
     */
    public function ready()
    {
        return ! empty($this->message());
    }

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
    public function flash($message, $type = '', array $options = [])
    {
        $data = [
            $this->sessionPrefix . 'message' => $message,
            $this->sessionPrefix . 'type'    => $type,
            $this->sessionPrefix . 'options' => json_encode($options),
        ];

        $this->session->flash($data);

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get session value.
     *
     * @param  string  $name
     *
     * @return mixed
     */
    private function getSession($name)
    {
        return $this->session->get($this->sessionPrefix . $name);
    }
}
