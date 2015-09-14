<?php namespace Arcanedev\Notify\Facades;

use Illuminate\Support\Facades\Facade as Facade;

/**
 * Class     Notify
 *
 * @package  Arcanedev\Notify\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Notify extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'arcanedev.notify'; }
}
