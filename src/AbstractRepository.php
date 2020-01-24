<?php

namespace bigpaulie\repository;


use bigpaulie\repository\Contracts\RepositoryInterface;
use bigpaulie\repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

/**
 * Class AbstractRepository
 * @package bigpaulie\repository
 */
abstract class AbstractRepository implements RepositoryInterface
{
    const DEFAULT_PAGE_SIZE = 25;

    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     * @param string|null $model
     */
    public function __construct(?string $model = null)
    {
        if (empty($model)) {
            $model = str_replace('Repository', '', class_basename($this));
            $this->model = \config('repository.model_namespace') . $model;
        } else {
            $this->model = $model;
        }
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model::all();
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Model
    {
        return $this->model::query()
            ->where('id', '=', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes, bool $mass = false): Model
    {
        /** @var Model $model */
        $model = null;
        if (!$mass) {
            $model = new $this->model;
            foreach ($attributes as $key => $attribute) {
                $model->{$key} = $attribute;
            }
        } else {
            $model = $this->model->fill($attributes);
        }

        $model->save();
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributes, $id_or_model): Model
    {
        if ($id_or_model instanceof Model) {
            $id_or_model = $id_or_model->id;
        }

        $updated = $this->find($id_or_model);
        $updated->update($attributes);
        return $updated;
    }

    /**
     * @inheritDoc
     */
    public function delete($id_or_model, bool $force = false): bool
    {
        /** @var Model $model */
        $model = null;
        if ($id_or_model instanceof Model) {
            $model = $id_or_model;
        } else {
            $model = $this->find($id_or_model);
            if (empty($model)) {
                throw new RepositoryException('Model not found', 404);
            }
        }

        if ($force) {
            return $model->forceDelete();
        }

        try {
            return $model->delete();
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
