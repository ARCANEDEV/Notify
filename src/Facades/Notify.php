<?php namespace Arcanedev\Notify\Facades;

use Arcanedev\Notify\Contracts\Notify as NotifyContract;
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
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return NotifyContract::class; }
}
