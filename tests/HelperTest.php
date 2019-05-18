<?php namespace Arcanedev\Notify\Tests;

use Illuminate\Support\Collection;

/**
 * Class     HelperTest
 *
 * @package  Arcanedev\Notify\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HelperTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_get_notify_instance()
    {
        $notify = notify();

        $expectations = [
            \Arcanedev\Notify\Contracts\Notify::class,
            \Arcanedev\Notify\Notify::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $notify);
        }

        static::assertTrue($notify->isEmpty());
        static::assertFalse($notify->isNotEmpty());
    }

    /** @test */
    public function it_can_flash_a_notification_with_only_message()
    {
        notify('Welcome Aboard');

        static::assertTrue(notify()->isNotEmpty());

        $expected = [
            [
                'message' => 'Welcome Aboard',
                'type'    => 'info',
                'extra'   => [],
            ]
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = notify()->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());

        notify()->flash('Welcome Aboard');

        $expected[] = [
            'message' => 'Welcome Aboard',
            'type'    => 'info',
            'extra'   => [],
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = notify()->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }

    /** @test */
    public function it_can_flash_a_notification_with_message_and_type()
    {
        notify("You've got an error!", 'danger');

        static::assertTrue(notify()->isNotEmpty());

        $expected = [
            [
                'message' => "You've got an error!",
                'type'    => 'danger',
                'extra'   => [],
            ]
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = notify()->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());

        notify()->flash('Welcome Aboard', 'info');

        $expected[] = [
            'message' => 'Welcome Aboard',
            'type'    => 'info',
            'extra'   => [],
        ];

        static::assertInstanceOf(
            Collection::class,
            $notifications = notify()->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }

    /** @test */
    public function it_can_flash_notification_with_extra_options()
    {
        notify()->flash('Welcome Aboard', 'success', [
            'content' => '<p>It is nice to see you again!</p>',
            'icon'    => ':tada:',
        ]);

        static::assertTrue(notify()->isNotEmpty());

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
            $notifications = notify()->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }

    /** @test */
    public function it_can_forget_all_the_notifications()
    {
        notify()->flash('Welcome Aboard');

        static::assertFalse(notify()->isEmpty());
        static::assertTrue(notify()->isNotEmpty());

        notify()->forget();

        static::assertTrue(notify()->isEmpty());
        static::assertFalse(notify()->isNotEmpty());
        static::assertEmpty(notify()->notifications());
    }

    /** @test */
    public function it_can_flash_with_predefined_types()
    {
        notify()->info('Info notification', ['icon' => 'info-icon']);
        notify()->success('Success notification', ['icon' => 'success-icon']);
        notify()->error('Error notification', ['icon' => 'error-icon']);
        notify()->warning('Warning notification', ['icon' => 'warning-icon']);

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
            $notifications = notify()->notifications()
        );
        static::assertEquals($expected, $notifications->toArray());
    }
}
