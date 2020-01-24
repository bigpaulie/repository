# Repository

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

A repository pattern implementation for Laravel Framework

## Installation

Via Composer

``` bash
$ composer require bigpaulie/repository
```

Publish the configuration file
```bash
$ php artisan vendor:publish --provider=bigpaulie\\repository\\RepositoryServiceProvider --tag=repository.config
```

## Compatibility
|package version|laravel version|
|---------------|---------------|
|2.x            | 6.9 or newer  |
|1.x            | 5.x           |

## Usage
A repository class is any class that extends bigpaulie\repository\AbstractRepository

The general rule of thumb is that your repository should have the same name as your model by with a suffix of "Repository".

Let's say we have the following case, we have a model named Person, than the repository class should be named PersonRepository

```php
class PersonRepository extends AbstractRepository {}
```

## Generating repositories using artisan commands
You can generate a repository for your model using the provided artisan command
```shell script
php artisan repository:generate Person
```
The above command will generate a repository class called PersonRepository.

### Find
Find a specific resource by it's ID

```php
/** @var PersonRepository $repository */
$repository = new PersonRepository();

/** @var Person|null $person */
$person = $repository->find(1);
```

### Get all 
Get all results for this resource

```php
/** @var PersonRepository */
$repository = new PersonRepository();

/** @var Illuminate\Database\Eloquent\Collection|Person[] */
$persons = $repository->all();
```

### Create
Create's a new resource and return the database object, if your model doesn't allow mass assigning of attributes, use `false` as the second parameter.
```php
/** @var PersonRepository $repository */
$repository = new PersonRepository();

/** @var Person $person */
$person = $repository->create([
    'name' => 'Popescu Ion',
    'age' => 30
]);
```
### Update
Update a specific resource by it's ID, you can also pass a model instance as a second parameter.

```php
/** @var PersonRepository $repository */
$repository = new PersonRepository();

/** @var Person $person */
$person = $repository->update([
    'name' => 'Popescu Marin',
    'age' => 33
], 1);
```
### Delete 
Delete a specific resource by it's ID, you can also force delete by passing `true` as the second parameter.
```php
/** @var PersonRepository $repository */
$repository = new PersonRepository();

try {
    /** @var Person $person */
    $person = $repository->delete(1);
} catch (RepositoryException $exception) {
    // do something if operation fails
}
```

## Using helper function
You can use the helper function by providing the FQDN of a repository or a model.

If a repository exists for a given model, an instance of the repository is returned otherwise an abstract repository is returned allowing you to preform all the builtin CRUD functionality.

The Person model has a PersonRepository
```php
/** @var PersonRepository $person */
$personRepository = repository(PersonRepository::class);

/** @var PersonRepository $person */
$personRepository = repository(Person::class);
```
The Dog model doesn't have a repository
```php
/** @var bigpaulie\repository\Repository $dog */
$repository = repository(Dog::class);
```

### Learn more 
Check out our [wiki](https://github.com/bigpaulie/repository/wiki)

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ ./vendor/bin/phpunit -c phpunit.xml
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Paul Purcel](https://github.com/bigpaulie)

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/bigpaulie/repository.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/bigpaulie/repository.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/bigpaulie/repository/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/bigpaulie/repository
[link-downloads]: https://packagist.org/packages/bigpaulie/repository
[link-travis]: https://travis-ci.org/bigpaulie/repository
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/bigpaulie
[link-contributors]: ../../contributors
[link-wiki]: https://github.com/bigpaulie/repository/wiki
