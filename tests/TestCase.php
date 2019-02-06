<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\Contracts\SessionStore;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\Notify\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Session prefix.
     *
     * @var string
     */
    protected $sessionPrefix;

    /** @var SessionStore|ObjectProphecy */
    protected $session;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->app->loadDeferredProviders();

        $this->sessionPrefix = config('notify.session.prefix', 'notifier.');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\Notify\NotifyServiceProvider::class,
        ];
    }
}
