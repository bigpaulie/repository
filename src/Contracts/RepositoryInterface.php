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
     * Get a collection of all the results.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a model by ID
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Create an save a new instance of a model.
     *
     * @param array $attributes
     * @param bool $mass
     * @return Model
     */
    public function create(array $attributes, bool $mass = false): Model;

    /**
     * Update a model.
     *
     * @param array $attributes
     * @param $id_or_model
     * @return Model
     */
    public function update(array $attributes, $id_or_model): Model;

    /**
     * Delete a specific model.
     *
     * @param $id_or_model
     * @param bool $force
     * @return bool
     * @throws RepositoryException
     */
    public function delete($id_or_model, bool $force = false):bool ;
}
