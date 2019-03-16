<?php

namespace bigpaulie\repository\tests;

use bigpaulie\repository\tests\bootstrap\migrations\PersonMigration;
use bigpaulie\repository\tests\bootstrap\seeders\PersonSeeder;

/**
 * Class TestCase
 * @package bigpaulie\repository\tests
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass()
    {
        with(new PersonMigration())->up();
    }

    protected function setUp()
    {
        with(new PersonSeeder())->run();
    }
}