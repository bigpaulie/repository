<?php

namespace bigpaulie\repository\tests\bootstrap\migrations;

/**
 * Interface MigrationInterface
 * @package bigpaulie\repository\tests\bootstrap\migrations
 */
interface MigrationInterface
{
    public function up();
    public function down();
}
