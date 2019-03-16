<?php

namespace bigpaulie\repository\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SearchableRepositoryInterface
 * @package bigpaulie\repository\Contracts
 */
interface SearchableRepositoryInterface
{
    const SEARCH_STARTS_WITH = 'starts_with';
    const SEARCH_ENDS_WITH = 'ends_with';
    const SEARCH_CONTAINS = 'contains';

    /**
     * Search for entities
     *
     * @param $term
     * @param array $attributes
     * @param string $type
     * @return Collection
     */
    public function search($term, array $attributes, string $type = self::SEARCH_CONTAINS):Collection;
}
