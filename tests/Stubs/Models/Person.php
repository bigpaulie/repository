<?php


namespace bigpaulie\repository\tests\Stubs\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @package bigpaulie\repository\tests\Stubs
 */
class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = ['name', 'age'];
}
