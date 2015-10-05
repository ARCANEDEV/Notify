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
