<?php namespace Arcanedev\Notify\Tests\Laravel;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    protected function getPackageProviders()
    {
        return ['Arcanedev\Notify\Laravel\ServiceProvider'];
    }

    protected function getPackageAliases()
    {
        return ['Notify' => 'Arcanedev\Notify\Laravel\Facade'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }
}
