<?php


namespace bigpaulie\repository\tests;

/**
 * Class TestCase
 * @package bigpaulie\repository\tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__. '/Stubs/Migrations');
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('repository.model_namespace', 'bigpaulie\\repository\\tests\\Stubs\\Models\\');
        $app['config']->set('repository.repository_namespace', 'bigpaulie\\repository\\tests\\Stubs\\Repositories\\');
    }
}
