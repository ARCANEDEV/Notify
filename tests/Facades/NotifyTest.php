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
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        $message = 'Welcome Aboard';

        Notify::flash($message);

        $this->assertTrue(Notify::ready());
        $this->assertEquals($message, Notify::message());
        $this->assertEmpty(Notify::type());
        $this->assertEmpty(Notify::options());
    }

    /** @test */
    public function it_can_flash_notification_with_type()
    {
        $message = 'Welcome Aboard';
        $type    = 'info';

        Notify::flash($message, $type);

        $this->assertTrue(Notify::ready());
        $this->assertEquals($message, Notify::message());
        $this->assertEquals($type,    Notify::type());
        $this->assertEmpty(Notify::options());
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

        Notify::flash($message, $type, $options);

        $this->assertTrue(Notify::ready());
        $this->assertEquals($message,             Notify::message());
        $this->assertEquals($type,                Notify::type());
        $this->assertEquals($options,             Notify::options(true));
        $this->assertEquals($options['color'],    Notify::option('color'));
        $this->assertEquals($options['position'], Notify::option('position'));
    }
}
