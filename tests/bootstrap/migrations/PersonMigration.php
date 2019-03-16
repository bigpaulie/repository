<?php

namespace bigpaulie\repository\tests\bootstrap\migrations;

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class PersonMigration
 * @package bigpaulie\repository\tests\bootstrap\migrations
 */
class PersonMigration implements MigrationInterface
{

    public function up()
    {
        DB::schema()->dropIfExists('persons');
        DB::schema()->create('persons', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('age');
            $table->timestamps();
        });
    }

    public function down()
    {
        DB::schema()->drop('persons');
    }
}
