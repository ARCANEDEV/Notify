<?php namespace Arcanedev\Notify\Tests\Laravel;

use Illuminate\Support\Facades\Session;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    const SESSION_NAME = 'notifyer';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    protected function getPackageProviders()
    {
        return ['Arcanedev\Notify\Laravel\ServiceProvider'];
    }

    protected function getPackageAliases()
    {
        return ['Notify' => 'Arcanedev\Notify\Laravel\Facade'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        //
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
        return Session::get(self::SESSION_NAME . '.' . $name);
    }
}
