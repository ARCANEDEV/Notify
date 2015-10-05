<?php

if ( ! function_exists('notify')) {
    /**
     * Notify Helper function
     *
     * @param  string|null  $message
     *
     * @return \Arcanedev\Notify\Contracts\NotifyInterface
     */
    function notify($message = null)
    {
        /** @var Arcanedev\Notify\Contracts\NotifyInterface $notifier */
        $notifier = app('arcanedev.notify');

        if ( ! is_null($message)) {
            $notifier->info($message);
        }

        return $notifier;
    }
}
