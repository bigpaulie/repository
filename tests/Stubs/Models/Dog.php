<?php


namespace bigpaulie\repository\tests\Stubs\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Dog
 * @package bigpaulie\repository\tests\Stubs
 */
class Dog extends Model
{
    protected $table = 'dogs';
    protected $fillable = ['name'];
}
