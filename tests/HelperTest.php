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

    public function setUp(): void
    {
        parent::setUp();

        static::assertFalse(notify()->ready());
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        notify($message = 'Welcome Aboard');

        static::assertTrue(notify()->ready());
        static::assertSame($message, notify()->message());
        static::assertSame('info',   notify()->type());
        static::assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_a_notification_with_message_and_type()
    {
        notify($message = "You've got an error!", $type = 'danger');

        static::assertTrue(notify()->ready());
        static::assertSame($message, notify()->message());
        static::assertSame($type,    notify()->type());
        static::assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_a_notification_with_only_message_two()
    {
        notify()->flash($message = 'Welcome Aboard');

        static::assertTrue(notify()->ready());
        static::assertSame($message, notify()->message());
        static::assertEmpty(notify()->type());
        static::assertEmpty(notify()->options());
    }

    /** @test */
    public function it_can_flash_notification_with_type()
    {
        $message = 'Welcome Aboard';
        $type    = 'info';

        notify()->flash($message, $type);

        static::assertTrue(notify()->ready());
        static::assertSame($message, notify()->message());
        static::assertSame($type,    notify()->type());
        static::assertEmpty(notify()->options());
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

        static::assertTrue(notify()->ready());
        static::assertSame($message,             notify()->message());
        static::assertSame($type,                notify()->type());
        static::assertSame($options,             notify()->options(true));
        static::assertSame($options['color'],    notify()->option('color'));
        static::assertSame($options['position'], notify()->option('position'));
    }
}
