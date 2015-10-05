<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\Contracts\SessionStoreContract;
use Arcanedev\Notify\Notify;
use Mockery as m;
use Mockery\MockInterface;

/**
 * Class     NotifyTest
 *
 * @package  Arcanedev\Notify\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SessionStoreContract|MockInterface */
    private $session;

    /** @var Notify */
    private $notify;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->session = m::mock(SessionStoreContract::class);
        $this->session->shouldReceive('flashMany');

        $this->notify  = new Notify($this->session, $this->sessionPrefix);
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
    public function it_displays_info_notifications()
    {
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'title', 'Notice');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'level', 'info');

        $this->notify->info('Welcome Aboard');
    }

    /** @test */
    public function it_displays_success_notifications()
    {
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'title', 'Notice');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'level', 'success');

        $this->notify->success('Welcome Aboard');
    }

    /** @test */
    public function it_displays_error_notifications()
    {
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'message', 'Uh Oh');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'title', 'Notice');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'level', 'danger');

        $this->notify->error('Uh Oh');
    }

    /** @test */
    public function it_displays_warning_notifications()
    {
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'message', 'Be careful!');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'title', 'Notice');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'level', 'warning');

        $this->notify->warning('Be careful!');
    }

    /** @test */
    public function it_displays_overlay_notifications()
    {
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'message', 'Overlay Message');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'title', 'Notice');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'level', 'info');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'overlay', true);

        $this->notify->overlay('Overlay Message');
    }

    /** @test */
    public function it_displays_important_notifications()
    {
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'title', 'Notice');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'level', 'info');
        $this->session->shouldReceive('flash')->with($this->sessionPrefix . 'important', true);

        $this->notify->info('Welcome Aboard')->important();
    }
}
