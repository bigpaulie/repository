<?php

namespace bigpaulie\repository\tests;

use bigpaulie\repository\tests\bootstrap\models\Person;
use bigpaulie\repository\tests\stubs\PersonRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PersonRepositoryTest
 * @package bigpaulie\repository\tests
 */
class PersonRepositoryTest extends TestCase
{
    /**
     * @var PersonRepository
     */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new PersonRepository();
    }

    public function testFindShouldPass()
    {
        /** @var Person $person */
        $person = $this->repository->find(1);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals('Popescu Ionescu', $person->name);
        $this->assertEquals(30, $person->age);
    }

    /**
     * @throws \bigpaulie\repository\Exceptions\RepositoryException
     * @expectedException \bigpaulie\repository\Exceptions\RepositoryException
     */
    public function testFindShouldFail()
    {
        /** @var Person $person */
        $person = $this->repository->find(22);
    }

    public function testGetAllShouldPass()
    {
        /** @var Person[]|\Illuminate\Database\Eloquent\Collection $persons */
        $persons = $this->repository->getAll();

        $this->assertInstanceOf(Collection::class, $persons);
        $this->assertCount(2, $persons);
    }

    public function testCreateShouldPass()
    {
        /** @var Person $person */
        $person = $this->repository->create([
            'name' => 'Popescu Ion',
            'age' => 53
        ]);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals('Popescu Ion', $person->name);
        $this->assertEquals(53, $person->age);
        $this->assertEquals(3, $person->id);
    }

    public function testUpdateShouldPass()
    {
        /** @var Person $person */
        $person = $this->repository->update([
            'name' => 'Popescu Marin',
            'age' => 54
        ], 2);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals('Popescu Marin', $person->name);
        $this->assertEquals(54, $person->age);
    }

    /**
     * @throws \bigpaulie\repository\Exceptions\RepositoryException
     * @expectedException \bigpaulie\repository\Exceptions\RepositoryException
     */
    public function testUpdateShouldFail()
    {
        /** @var Person $person */
        $person = $this->repository->update([
            'name' => 'Popescu Marin',
            'age' => 54
        ], 33);
    }

    public function testDeleteShouldPass()
    {
        /** @var bool $person */
        $person = $this->repository->delete(2);
        $this->assertTrue($person);
    }

    /**
     * @throws \bigpaulie\repository\Exceptions\RepositoryException
     * @expectedException \bigpaulie\repository\Exceptions\RepositoryException
     */
    public function testDeleteShouldFail()
    {
        /** @var bool $person */
        $person = $this->repository->delete(22);
    }

    public function testSearchShouldPass()
    {
        /** @var Collection|Person[] $persons */
        $persons = $this->repository->search('Popescu', ['name']);

        /** @var Person $person */
        $person = $persons->first();

        $this->assertInstanceOf(Collection::class, $persons);
        $this->assertGreaterThanOrEqual(1, $persons->count());
        $this->assertEquals('Popescu Ionescu', $person->name);
    }
}
