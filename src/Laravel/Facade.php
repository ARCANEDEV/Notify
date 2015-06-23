<?php namespace Arcanedev\Notify\Laravel;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * Class Facade
 * @package Arcanedev\Notify\Laravel
 */
class Facade extends IlluminateFacade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'arcanedev.notify'; }
}
