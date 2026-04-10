<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereStatistics
{
    /**
     * Filter the query by the population of the country.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function wherePopulation(Builder $query, string $population): Builder
    {
        return $query->where('population', $population);
    }

    /**
     * Filter the query by the area of the country in square kilometers (km²).
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereAreaKm2(Builder $query, string $area): Builder
    {
        return $query->where('area', $area);
    }

    /**
     * Filter the query by the country's gross domestic product (GDP).
     * In billions of USD.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereGdp(Builder $query, string $gdp): Builder
    {
        return $query->where('gdp', $gdp);
    }
}
