<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\Contracts\SessionStore;
use Arcanedev\Notify\Notify;

/**
 * Class     NotifyTest
 *
 * @package  Arcanedev\Notify\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var Notify */
    private $notify;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->notify  = new Notify(app(SessionStore::class), $this->sessionPrefix);

        static::assertFalse($this->notify->ready());
    }

    public function tearDown(): void
    {
        unset($this->notify);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated_via_the_contract()
    {
        $this->notify = $this->app->make(\Arcanedev\Notify\Contracts\Notify::class);

        $expectations = [
            \Arcanedev\Notify\Contracts\Notify::class,
            \Arcanedev\Notify\Notify::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->notify);
        }
    }

    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        $message = 'Welcome Aboard';

        $this->notify->flash($message);

        static::assertTrue($this->notify->ready());
        static::assertEquals($message, $this->notify->message());
        static::assertEmpty($this->notify->type());
        static::assertEmpty($this->notify->options());
    }

    /** @test */
    public function it_can_flash_notification_with_type()
    {
        $message = 'Welcome Aboard';
        $type    = 'info';

        $this->notify->flash($message, $type);

        static::assertTrue($this->notify->ready());
        static::assertEquals($message, $this->notify->message());
        static::assertEquals($type,    $this->notify->type());
        static::assertEmpty($this->notify->options());
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

        static::assertTrue($this->notify->ready());
        static::assertTrue($this->notify->hasOption('color'));
        static::assertTrue($this->notify->hasOption('position'));

        static::assertEquals($message,             $this->notify->message());
        static::assertEquals($type,                $this->notify->type());
        static::assertEquals($options,             $this->notify->options(true));
        static::assertEquals($options['color'],    $this->notify->option('color'));
        static::assertEquals($options['position'], $this->notify->option('position'));
    }
}
