<?php

if ( ! function_exists('notify')) {
    /**
     * Notify Helper function
     *
     * @param  string|null $message
     *
     * @return \Arcanedev\Notify\Notify
     */
    function notify($message = null)
    {
        $notifier = app('arcanedev.notify');

        if ( ! is_null($message)) {
            return $notifier->info($message);
        }

        return $notifier;
    }
}
