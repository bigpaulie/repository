<?php


namespace bigpaulie\repository\tests;

use bigpaulie\repository\AbstractRepository;
use bigpaulie\repository\Exceptions\RepositoryException;
use bigpaulie\repository\tests\Stubs\Models\Dog;
use bigpaulie\repository\tests\Stubs\Models\Person;
use bigpaulie\repository\tests\Stubs\Repositories\PersonRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AbstractRepositoryInstanceForModelTest
 * @package bigpaulie\repository\tests
 */
class AbstractRepositoryInstanceForModelTest extends TestCase
{
    public function testAbstractRepositoryRepositoryInstanceShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        $this->assertInstanceOf(AbstractRepository::class, $repository);
    }

    public function testAbstractRepositoryRepositoryAllShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        $repository->create(['name' => 'Maxx']);
        $repository->create(['name' => 'Lord']);
        $repository->create(['name' => 'Lessie']);

        /** @var Collection $collection */
        $collection = $repository->all();
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(3, $collection);
    }

    public function testAbstractRepositoryRepositoryCreateShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        /** @var Dog $dog */
        $dog = $repository->create(['name' => 'Lessie']);
        $this->assertInstanceOf(Dog::class, $dog);
        $this->assertEquals('Lessie', $dog->name);
    }

    public function testAbstractRepositoryRepositoryFindShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        $repository->create(['name' => 'Lessie']);

        /** @var Dog|null $dog */
        $dog = $repository->find(1);
        $this->assertInstanceOf(Dog::class, $dog);
        $this->assertEquals('Lessie', $dog->name);
    }

    public function testAbstractRepositoryRepositoryUpdateByIdShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        /** @var Dog $dog */
        $dog = $repository->create(['name' => 'Lessie']);

        /** @var Dog $updated */
        $updated = $repository->update(['name' => 'Dilly'], $dog->id);
        $this->assertInstanceOf(Dog::class, $updated);
        $this->assertEquals('Dilly', $updated->name);
    }

    public function testAbstractRepositoryRepositoryUpdateByModelShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        /** @var Dog $dog */
        $dog = $repository->create(['name' => 'Lessie']);

        /** @var Dog $updated */
        $updated = $repository->update(['name' => 'Dilly'], $dog);
        $this->assertInstanceOf(Dog::class, $updated);
        $this->assertEquals('Dilly', $updated->name);
    }

    public function testAbstractRepositoryRepositoryDeleteByIdShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        /** @var Dog $dog */
        $dog = $repository->create(['name' => 'Paul']);

        /** @var bool $deleted */
        $deleted = $repository->delete($dog->id);
        $this->assertTrue($deleted);
    }

    public function testAbstractRepositoryRepositoryDeleteByModelShouldPass()
    {
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        /** @var Dog $dog */
        $dog = $repository->create(['name' => 'Paul']);

        /** @var bool $deleted */
        $deleted = $repository->delete($dog);
        $this->assertTrue($deleted);
    }

    public function testAbstractRepositoryRepositoryDeleteByIdShouldFail()
    {
        $this->expectException(RepositoryException::class);
        /** @var AbstractRepository $repository */
        $repository = repository(Dog::class);
        $repository->delete(1);
    }
}
