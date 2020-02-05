<?php

declare(strict_types=1);

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
    function notify(string $message = null, string $type = 'info', array $extra = []): Notify
    {
        /** @var  Arcanedev\Notify\Contracts\Notify  $notifier */
        $notifier = app(Notify::class);

        if (is_null($message)) {
            return $notifier;
        }

        return $notifier->flash($message, $type, $extra);
    }
}
