<?php namespace Arcanedev\Notify\Tests\Laravel;

use Arcanedev\Notify\Laravel\Facade as Notify;
use Illuminate\Support\Facades\Session;

class NotifyTest extends TestCase
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

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_displays_default_notifications()
    {
        $message = 'Welcome Aboard';

        Notify::message($message);

        $this->assertNotification($message);
    }

    /** @test */
    public function it_displays_info_notifications()
    {
        $message = 'Welcome Aboard';

        Notify::info($message);

        $this->assertNotification($message, 'info');
    }

    /** @test */
    public function it_displays_success_notifications()
    {
        $message = 'Welcome Aboard';

        Notify::success($message);

        $this->assertNotification($message, 'success');
    }

    /** @test */
    public function it_displays_error_notifications()
    {
        $message = 'Uh Oh';

        Notify::error($message);

        $this->assertNotification($message, 'danger');
    }

    /** @test */
    public function it_displays_warning_notifications()
    {
        $message = 'Be careful!';
        Notify::warning($message);

        $this->assertNotification($message, 'warning');
    }

    /** @test */
    public function it_displays_overlay_notifications()
    {
        $message = 'Overlay Message';
        Notify::overlay($message);

        $this->assertNotification($message);
        $this->assertTrue($this->getSession('overlay'));
    }

    /** @test */
    public function it_displays_important_notifications()
    {
        $message = 'Welcome Aboard';
        Notify::message($message)->important();

        $this->assertNotification($message);
        $this->assertTrue($this->getSession('important'));
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
    private function assertNotification($message, $level = 'info')
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
    private function getSession($name)
    {
        return Session::get(self::SESSION_NAME . '.' . $name);
    }
}
