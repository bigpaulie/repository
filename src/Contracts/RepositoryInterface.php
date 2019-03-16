<?php

namespace bigpaulie\repository\Contracts;

use bigpaulie\repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package bigpaulie\repository\Contracts
 */
interface RepositoryInterface
{
    /**
     * Find an existing resource
     *
     * @param $id
     * @return Model
     * @throws RepositoryException
     */
    public function find($id):Model;

    /**
     * Get a collection of models
     *
     * @return Collection
     * @throws RepositoryException
     */
    public function getAll():Collection;

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return Model
     * @throws RepositoryException
     */
    public function create(array $attributes):Model;

    /**
     * Update an existing resource
     *
     * @param array $attributes
     * @param $id
     * @return Model
     * @throws RepositoryException
     */
    public function update(array $attributes, $id):Model;

    /**
     * Delete an existing resource
     *
     * @param $id
     * @return bool
     * @throws RepositoryException
     */
    public function delete($id):bool ;
}
