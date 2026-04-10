<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereIsoNumeric
{
    /**
     * Find a model by iso Numeric.
     *
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIsoNumeric(Builder $query, string $isoNumeric): Builder
    {
        return $query->where('iso_numeric', $isoNumeric);
    }

    /**
     * Filter the query by the ISO Numeric, or-ing the query when the builder
     * already has a where clause.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereIsoNumeric(Builder $query, string $isoNumeric): Builder
    {
        return $query->orWhere('iso_numeric', $isoNumeric);
    }
}
