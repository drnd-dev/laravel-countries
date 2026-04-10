<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereName
{
    /**
     * Find a model by name.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereName(Builder $query, string $name): Builder
    {
        $query->whereTranslation('name', $name);

        return $query;
    }

    /**
     * Find a model by name with OR condition.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereName(Builder $query, string $name): Builder
    {
        $query->orWhereTranslation('name', $name);

        return $query;
    }

    /**
     * Find a model by name with LIKE condition.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereNameLike(Builder $query, string $name): Builder
    {
        $query->whereTranslationLike('name', '% '.$name.'%');

        return $query;
    }

    /**
     * Find a model by name with LIKE condition and OR operator.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereNameLike(Builder $query, string $name): Builder
    {
        $query->orWhereTranslationLike('name', '% '.$name.'%');

        return $query;
    }

    /**
     * Sort the query by name.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orderByName(Builder $query, string $sortMethod = 'asc'): Builder
    {
        return $query->orderByTranslation('name', $sortMethod);
    }
}
