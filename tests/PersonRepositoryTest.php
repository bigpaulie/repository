<?php


namespace bigpaulie\repository\tests;

use bigpaulie\repository\AbstractRepository;
use bigpaulie\repository\Exceptions\RepositoryException;
use bigpaulie\repository\tests\Stubs\Models\Person;
use bigpaulie\repository\tests\Stubs\Repositories\PersonRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PersonRepositoryTest
 * @package bigpaulie\repository\tests
 */
class PersonRepositoryTest extends TestCase
{
    public function testPersonRepositoryInstanceShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        $this->assertInstanceOf(AbstractRepository::class, $repository);
    }

    public function testPersonRepositoryAllShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        $repository->create(['name' => 'Paul', 'age' => 32]);
        $repository->create(['name' => 'Dan', 'age' => 22]);
        $repository->create(['name' => 'Don', 'age' => 43]);

        /** @var Collection $collection */
        $collection = $repository->all();
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(3, $collection);
    }

    public function testPersonRepositoryCreateShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        /** @var Person $person */
        $person = $repository->create(['name' => 'Paul', 'age' => 32]);
        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals('Paul', $person->name);
        $this->assertEquals(32, $person->age);
        $this->assertIsInt($person->id);
    }

    public function testPersonRepositoryFindShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        $repository->create(['name' => 'Paul', 'age' => 32]);

        /** @var Person|null $person */
        $person = $repository->find(1);
        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals('Paul', $person->name);
        $this->assertEquals(32, $person->age);
    }

    public function testPersonRepositoryUpdateByIdShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        /** @var Person $person */
        $person = $repository->create(['name' => 'Paul', 'age' => 32]);

        /** @var Person $updated */
        $updated = $repository->update(['name' => 'John'], $person->id);
        $this->assertInstanceOf(Person::class, $updated);
        $this->assertEquals('John', $updated->name);
    }

    public function testPersonRepositoryUpdateByModelShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        /** @var Person $person */
        $person = $repository->create(['name' => 'Paul', 'age' => 32]);

        /** @var Person $updated */
        $updated = $repository->update(['name' => 'John'], $person);
        $this->assertInstanceOf(Person::class, $updated);
        $this->assertEquals('John', $updated->name);
    }

    public function testPersonRepositoryDeleteByIdShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        /** @var Person $person */
        $person = $repository->create(['name' => 'Paul', 'age' => 32]);

        /** @var bool $deleted */
        $deleted = $repository->delete($person->id);
        $this->assertTrue($deleted);
    }

    public function testPersonRepositoryDeleteByModelShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        /** @var Person $person */
        $person = $repository->create(['name' => 'Paul', 'age' => 32]);

        /** @var Person $deleted */
        $deleted = $repository->delete($person);
        $this->assertTrue($deleted);
    }

    public function testPersonRepositoryDeleteByIdShouldFail()
    {
        $this->expectException(RepositoryException::class);
        /** @var AbstractRepository $repository */
        $repository = new PersonRepository();
        $repository->delete(1);
    }

    public function testPersonRepositoryInstanceFromHelperShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Person::class);
        $this->assertInstanceOf(PersonRepository::class, $repository);
    }

    public function testPersonRepositoryInstanceFromHelperByRepositoryClassShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(PersonRepository::class);
        $this->assertInstanceOf(PersonRepository::class, $repository);
    }
}
