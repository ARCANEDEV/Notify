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
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->assertFalse(notify()->ready());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_flash_a_notification_with_only_message_one()
    {
        $message = 'Welcome Aboard';

        notify($message);

        $this->assertTrue(notify()->ready());
        $this->assertEquals($message, notify()->message());
        $this->assertEmpty(notify()->type());
        $this->assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_a_notification_with_only_message_two()
    {
        $message = 'Welcome Aboard';

        notify()->flash($message);

        $this->assertTrue(notify()->ready());
        $this->assertEquals($message, notify()->message());
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
        $this->assertEquals($message, notify()->message());
        $this->assertEquals($type,    notify()->type());
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
        $this->assertEquals($message,             notify()->message());
        $this->assertEquals($type,                notify()->type());
        $this->assertEquals($options,             notify()->options(true));
        $this->assertEquals($options['color'],    notify()->option('color'));
        $this->assertEquals($options['position'], notify()->option('position'));
    }
}
