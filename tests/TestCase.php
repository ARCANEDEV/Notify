<?php namespace Arcanedev\Notify\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\Notify\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Session prefix.
     *
     * @var string
     */
    protected $sessionPrefix;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->sessionPrefix = config('notify.session.prefix', 'notifier.');
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  TestBench Functions
     | ------------------------------------------------------------------------------------------------
     */
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

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Notify' => \Arcanedev\Notify\Facades\Notify::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }

    /**
     * Call artisan command and return code.
     *
     * @param  string  $command
     * @param  array   $parameters
     *
     * @return int
     */
    public function artisan($command, $parameters = [])
    {
        // TODO: Implement artisan() method.
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Assert Notification
     *
     * @param string $message
     * @param string $level
     */
    protected function assertNotification($message, $level = 'info')
    {
        $this->assertEquals($message, $this->getSession('message'));
        $this->assertEquals($level, $this->getSession('level'));
    }

    /**
     * Get session value
     *
     * @param  string $name
     *
     * @return mixed
     */
    protected function getSession($name)
    {
        return session()->get($this->sessionPrefix . $name);
    }
}
