<?php

namespace bigpaulie\repository\tests\bootstrap\seeders;

use Illuminate\Database\Capsule\Manager as DB;
use bigpaulie\repository\tests\bootstrap\models\Person;

/**
 * Class PersonSeeder
 * @package bigpaulie\repository\tests\bootstrap\seeders
 */
class PersonSeeder
{
    public function run()
    {
        DB::table('persons')->delete();
        Person::unguard();
        Person::create(['id' => 1, 'name' => 'Popescu Ionescu', 'age' => 30]);
        Person::create(['id' => 2, 'name' => 'Popescu Marin', 'age' => 33]);
        Person::reguard();
    }
}
