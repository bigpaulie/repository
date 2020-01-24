<?php

if (!function_exists('repository')) {

    /**
     * @param string $repository_or_model
     * @return \bigpaulie\repository\AbstractRepository
     * @throws \bigpaulie\repository\Exceptions\RepositoryException
     */
    function repository(string $repository_or_model)
    {
        if (!class_exists($repository_or_model)) {
            throw new \bigpaulie\repository\Exceptions\RepositoryException(
                'Unable to load repository or model class '. $repository_or_model,
                500
            );
        }

        /** @var string $namespace */
        $namespace = config('repository.repository_namespace');

        if (strstr($repository_or_model, $namespace)) {
            return new $repository_or_model;
        }

        /** @var string $repository */
        $repository = $namespace . class_basename($repository_or_model) . 'Repository';
        if (class_exists($repository)) {
            return new $repository;
        }

        return new \bigpaulie\repository\Repository($repository_or_model);
    }
}
