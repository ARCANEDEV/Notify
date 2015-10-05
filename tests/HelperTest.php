<?php namespace Arcanedev\Notify\Tests;

/**
 * Class     HelperTest
 *
 * @package  Arcanedev\Notify\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HelperTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_displays_default_notifications()
    {
        $message = 'Welcome Aboard';

        notify($message);

        $this->assertNotification($message);
    }

    /** @test */
    public function it_displays_info_notifications()
    {
        $message = 'Welcome Aboard';

        notify()->info($message);

        $this->assertNotification($message, 'info');
    }

    /** @test */
    public function it_displays_success_notifications()
    {
        $message = 'Welcome Aboard';

        notify()->success($message);

        $this->assertNotification($message, 'success');
    }

    /** @test */
    public function it_displays_error_notifications()
    {
        $message = 'Uh Oh';

        notify()->error($message);

        $this->assertNotification($message, 'danger');
    }

    /** @test */
    public function it_displays_warning_notifications()
    {
        $message = 'Be careful!';
        notify()->warning($message);

        $this->assertNotification($message, 'warning');
    }

    /** @test */
    public function it_displays_overlay_notifications()
    {
        $message = 'Overlay Message';
        notify()->overlay($message);

        $this->assertNotification($message);
        $this->assertTrue($this->getSession('overlay'));
    }

    /** @test */
    public function it_displays_important_notifications()
    {
        $message = 'Welcome Aboard';
        notify()->info($message)->important();

        $this->assertNotification($message);
        $this->assertTrue($this->getSession('important'));
    }
}
