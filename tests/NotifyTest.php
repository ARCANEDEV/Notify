<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\Notify;
use Mockery as m;
use Mockery\MockInterface;

class NotifyTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var MockInterface */
    private $session;

    /** @var Notify */
    private $notify;

    const SESSION_NAME = 'notifyer';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->session = m::mock('Arcanedev\Notify\Contracts\SessionStoreContract');
        $this->notify  = new Notify($this->session);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->session);
        unset($this->notify);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_displays_default_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'info');

        $this->notify->message('Welcome Aboard');
    }

    /** @test */
    public function it_displays_info_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'info');

        $this->notify->info('Welcome Aboard');
    }

    /** @test */
    public function it_displays_success_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'success');

        $this->notify->success('Welcome Aboard');
    }

    /** @test */
    public function it_displays_error_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Uh Oh');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'danger');

        $this->notify->error('Uh Oh');
    }

    /** @test */
    public function it_displays_warning_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Be careful!');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'warning');

        $this->notify->warning('Be careful!');
    }

    /** @test */
    public function it_displays_custom_message_titles()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'You are now signed up.');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Success Heading');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'success');

        $this->notify->success('You are now signed up.', 'Success Heading');
    }

    /** @test */
    public function it_displays_overlay_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Overlay Message');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'info');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.overlay', true);

        $this->notify->overlay('Overlay Message');
    }

    /** @test */
    public function it_displays_important_notifications()
    {
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.title', 'Notice');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.level', 'info');
        $this->session->shouldReceive('flash')->with(self::SESSION_NAME . '.important', true);

        $this->notify->message('Welcome Aboard')->important();
    }
}
