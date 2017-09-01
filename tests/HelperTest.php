<?php namespace Arcanedev\Notify\Tests;

/**
 * Class     HelperTest
 *
 * @package  Arcanedev\Notify\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HelperTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->assertFalse(notify()->ready());
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        notify($message = 'Welcome Aboard');

        $this->assertTrue(notify()->ready());
        $this->assertSame($message, notify()->message());
        $this->assertSame('info',   notify()->type());
        $this->assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_a_notification_with_message_and_type()
    {
        notify($message = "You've got an error!", $type = 'danger');

        $this->assertTrue(notify()->ready());
        $this->assertSame($message, notify()->message());
        $this->assertSame($type,    notify()->type());
        $this->assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_a_notification_with_only_message_two()
    {
        notify()->flash($message = 'Welcome Aboard');

        $this->assertTrue(notify()->ready());
        $this->assertSame($message, notify()->message());
        $this->assertEmpty(notify()->type());
        $this->assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_notification_with_type()
    {
        $message = 'Welcome Aboard';
        $type    = 'info';

        notify()->flash($message, $type);

        $this->assertTrue(notify()->ready());
        $this->assertSame($message, notify()->message());
        $this->assertSame($type,    notify()->type());
        $this->assertEmpty(notify()->options());
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

        notify()->flash($message, $type, $options);

        $this->assertTrue(notify()->ready());
        $this->assertSame($message,             notify()->message());
        $this->assertSame($type,                notify()->type());
        $this->assertSame($options,             notify()->options(true));
        $this->assertSame($options['color'],    notify()->option('color'));
        $this->assertSame($options['position'], notify()->option('position'));
    }
}
