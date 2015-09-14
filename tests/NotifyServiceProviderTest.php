<?php namespace Arcanedev\Notify\Tests;

use Arcanedev\Notify\NotifyServiceProvider;

/**
 * Class     NotifyServiceProviderTest
 *
 * @package  Arcanedev\Notify\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @var NotifyServiceProvider
     */
    private $serviceProvider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->serviceProvider = new NotifyServiceProvider($this->app);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->serviceProvider);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @test
     */
    public function testCanGetWhatHeProvides()
    {
        // This is for 100% code converge
        $this->assertEquals([
            'arcanedev.notify'
        ], $this->serviceProvider->provides());
    }
}
