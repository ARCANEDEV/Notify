<?php namespace Arcanedev\Notify\Tests\Facades;

use Arcanedev\Notify\Facades\Notify as Notify;
use Arcanedev\Notify\Tests\TestCase;

/**
 * Class     NotifyTest
 *
 * @package  Arcanedev\Notify\Tests\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyTest extends TestCase
{
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
}
