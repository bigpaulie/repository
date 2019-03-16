<?php

namespace bigpaulie\repository;


use bigpaulie\repository\Contracts\RepositoryInterface;
use bigpaulie\repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package bigpaulie\repository
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @return string
     */
    abstract protected static function getModel():string;

    /**
     * Find an existing resource
     *
     * @param $id
     * @return Model
     * @throws RepositoryException
     */
    public function find($id): Model
    {
        try {
            /** @var string $model */
            $model = static::getModel();
            return $model::findOrFail($id);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Get a collection of models
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        /** @var string $model */
        $model = static::getModel();
        return $model::all();
    }

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return Model
     * @throws RepositoryException
     */
    public function create(array $attributes): Model
    {
        /** @var string $model */
        $model = static::getModel();

        try {
            /** @var Model $resource */
            $resource = new $model();
            $resource->fill($attributes);
            $resource->saveOrFail();
            return $resource;
        } catch (\Throwable $e) {
            throw new RepositoryException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update an existing resource
     *
     * @param array $attributes
     * @param $id
     * @return Model
     * @throws RepositoryException
     */
    public function update(array $attributes, $id): Model
    {
        try {
            /** @var Model $model */
            $model = $this->find($id);
            $model->fill($attributes);
            $model->saveOrFail();

            return $model;
        } catch (\Throwable $e) {
            throw new RepositoryException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete an existing resource
     *
     * @param $id
     * @return bool
     * @throws RepositoryException
     */
    public function delete($id): bool
    {
        try {
            $this->find($id)->delete();
            return true;
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
