<?php

namespace bigpaulie\repository\tests\bootstrap\models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @package bigpaulie\repository\tests\bootstrap\models
 *
 * @property-read int $id
 * @property string $name
 * @property int $age
 */
class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = ['name', 'age'];
}
