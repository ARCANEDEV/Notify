<?php

use Arcanedev\Notify\Contracts\Notify;

if ( ! function_exists('notify')) {
    /**
     * Notify Helper function.
     *
     * @param  string|null  $message
     * @param  string       $type
     * @param  array        $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    function notify($message = null, $type = 'info', array $extra = []): Notify
    {
        /** @var  Arcanedev\Notify\Contracts\Notify  $notifier */
        $notifier = app(Notify::class);

        return is_null($message) ? $notifier : $notifier->flash($message, $type, $extra);
    }
}
