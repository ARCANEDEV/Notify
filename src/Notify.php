<?php namespace Arcanedev\Notify;

use Arcanedev\Notify\Contracts\Notify as NotifyContract;
use Arcanedev\Notify\Contracts\SessionStore;
use Illuminate\Support\Arr;

/**
 * Class     Notify
 *
 * @package  Arcanedev\Notify
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Notify implements NotifyContract
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
    protected $sessionPrefix;

    /**
     * The session writer.
     *
     * @var \Arcanedev\Notify\Contracts\SessionStore
     */
    private $session;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new flash notifier instance.
     *
     * @param  \Arcanedev\Notify\Contracts\SessionStore  $session
     * @param  string                                    $prefix
     */
    public function __construct(SessionStore $session, $prefix)
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
     * @param  bool  $assoc
     *
     * @return array
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
        return Arr::get($this->options(true), $key, $default);
    }

    /**
     * Check if the flash notification has an option.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function hasOption($key)
    {
        return Arr::has($this->options(true), $key);
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
        $this->session->flash([
            $this->getPrefixedName('message') => $message,
            $this->getPrefixedName('type')    => $type,
            $this->getPrefixedName('options') => json_encode($options),
        ]);

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Prefix the name.
     *
     * @param  string  $name
     *
     * @return string
     */
    private function getPrefixedName($name)
    {
        return "{$this->sessionPrefix}.$name";
    }

    /**
     * Get session value.
     *
     * @param  string  $name
     *
     * @return mixed
     */
    private function getSession($name)
    {
        return $this->session->get(
            $this->getPrefixedName($name)
        );
    }
}
