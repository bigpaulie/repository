<?php

namespace bigpaulie\repository\tests\stubs;


use bigpaulie\repository\AbstractRepository;
use bigpaulie\repository\Concerns\Searchable;
use bigpaulie\repository\tests\bootstrap\models\Person;

/**
 * Class PersonRepository
 * @package bigpaulie\repository\tests\stubs
 */
class PersonRepository extends AbstractRepository
{
    use Searchable;

    /**
     * @return string
     */
    protected static function getModel(): string
    {
        return Person::class;
    }
}
