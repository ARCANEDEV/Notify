<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\Contracts\Store;
use Arcanedev\Notify\Notify;
use Illuminate\Support\Collection;

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

        $this->notify  = new Notify($this->app->make(Store::class));
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

        static::assertTrue($this->notify->isEmpty());
        static::assertFalse($this->notify->isNotEmpty());
    }

    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        $this->notify->flash('Welcome Aboard');

        static::assertFalse($this->notify->isEmpty());
        static::assertTrue($this->notify->isNotEmpty());

        $expected = [
            [
                'message' => 'Welcome Aboard',
                'type'    => 'info',
                'extra'   => [],
            ]
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = $this->notify->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }

    /** @test */
    public function it_can_flash_notification_with_type()
    {
        $this->notify->flash('Welcome Aboard', 'success');

        static::assertFalse($this->notify->isEmpty());
        static::assertTrue($this->notify->isNotEmpty());

        $expected = [
            [
                'message' => 'Welcome Aboard',
                'type'    => 'success',
                'extra'   => [],
            ]
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = $this->notify->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }

    /** @test */
    public function it_can_flash_notification_with_extra_options()
    {
        $this->notify->flash('Welcome Aboard', 'success', [
            'content' => '<p>It is nice to see you again!</p>',
            'icon'    => ':tada:',
        ]);

        static::assertFalse($this->notify->isEmpty());
        static::assertTrue($this->notify->isNotEmpty());

        $expected = [
            [
                'message' => 'Welcome Aboard',
                'type'    => 'success',
                'extra'   => [
                    'content' => '<p>It is nice to see you again!</p>',
                    'icon'    => ':tada:',
                ],
            ]
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = $this->notify->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }

    /** @test */
    public function it_can_forget_all_the_notifications()
    {
        $this->notify->flash('Welcome Aboard');

        static::assertFalse($this->notify->isEmpty());
        static::assertTrue($this->notify->isNotEmpty());

        $this->notify->forget();

        static::assertTrue($this->notify->isEmpty());
        static::assertFalse($this->notify->isNotEmpty());
        static::assertEmpty($this->notify->notifications());
    }

    /** @test */
    public function it_can_flash_with_predefined_types()
    {
        $this->notify->info('Info notification', ['icon' => 'info-icon']);
        $this->notify->success('Success notification', ['icon' => 'success-icon']);
        $this->notify->error('Error notification', ['icon' => 'error-icon']);
        $this->notify->warning('Warning notification', ['icon' => 'warning-icon']);

        $expected = [
            [
                'message' => 'Info notification',
                'type'    => 'info',
                'extra'   => [
                    'icon' => 'info-icon',
                ],
            ],
            [
                'message' => 'Success notification',
                'type'    => 'success',
                'extra'   => [
                    'icon' => 'success-icon',
                ],
            ],
            [
                'message' => 'Error notification',
                'type'    => 'danger',
                'extra'   => [
                    'icon' => 'error-icon',
                ],
            ],
            [
                'message' => 'Warning notification',
                'type'    => 'warning',
                'extra'   => [
                    'icon' => 'warning-icon',
                ],
            ],
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = $this->notify->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }
}
