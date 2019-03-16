<?php

namespace bigpaulie\repository\Concerns;


use bigpaulie\repository\Contracts\SearchableRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Trait Searchable
 * @package bigpaulie\repository\Concerns
 */
trait Searchable
{
    /**
     * Search for entities
     *
     * @param $term
     * @param array $attributes
     * @param string $type
     * @return Collection
     */
    public function search($term, array $attributes, string $type = SearchableRepositoryInterface::SEARCH_CONTAINS):Collection
    {
        /** @var string $entity */
        $entity = static::getModel();

        /** @var Builder $collection */
        $collection = $entity::where(function (Builder $query) use ($term, $attributes, $type) {
            /** @var string $attribute */
            foreach ($attributes as $attribute) {
                if (SearchableRepositoryInterface::SEARCH_CONTAINS === $type) {
                    $query->where($attribute, 'LIKE', "%". $term . "%");
                } elseif (SearchableRepositoryInterface::SEARCH_STARTS_WITH === $type) {
                    $query->where($attribute, 'LIKE', "%". $term);
                } elseif (SearchableRepositoryInterface::SEARCH_ENDS_WITH === $type) {
                    $query->where($attribute, 'LIKE', $term . "%");
                }
            }
        });

        return $collection->get();
    }
}
