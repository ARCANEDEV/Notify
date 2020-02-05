<?php

declare(strict_types=1);

namespace Arcanedev\Notify\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

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

    /** @var \Arcanedev\Notify\Contracts\Store|\Prophecy\Prophecy\ObjectProphecy */
    protected $session;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
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
    protected function getPackageProviders($app): array
    {
        return [
            \Arcanedev\Notify\NotifyServiceProvider::class,
        ];
    }
}
