<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\Contracts\SessionStoreContract;
use Arcanedev\Notify\Notify;
use Prophecy\Argument;

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
    /** @var Notify */
    private $notify;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->notify  = new Notify(app(SessionStoreContract::class), $this->sessionPrefix);

        $this->assertFalse($this->notify->ready());
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->notify);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        $message = 'Welcome Aboard';

        $this->notify->flash($message);

        $this->assertTrue($this->notify->ready());
        $this->assertEquals($message, $this->notify->message());
        $this->assertEmpty($this->notify->type());
        $this->assertEmpty($this->notify->options());
    }

    /** @test */
    public function it_can_flash_notification_with_type()
    {
        $message = 'Welcome Aboard';
        $type    = 'info';

        $this->notify->flash($message, $type);

        $this->assertTrue($this->notify->ready());
        $this->assertEquals($message, $this->notify->message());
        $this->assertEquals($type,    $this->notify->type());
        $this->assertEmpty($this->notify->options());
    }

    /** @test */
    public function it_can_flash_notification_with_options()
    {
        $message = 'Welcome Aboard';
        $type    = 'success';
        $options = [
            'color'     => '#BADA55',
            'position'  => 'absolute',
        ];

        $this->notify->flash($message, $type, $options);

        $this->assertTrue($this->notify->ready());
        $this->assertEquals($message,             $this->notify->message());
        $this->assertEquals($type,                $this->notify->type());
        $this->assertEquals($options,             $this->notify->options(true));
        $this->assertEquals($options['color'],    $this->notify->option('color'));
        $this->assertEquals($options['position'], $this->notify->option('position'));
    }
}
