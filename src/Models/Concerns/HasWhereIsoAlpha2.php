<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereIsoAlpha2
{
    /**
     * Find a model by iso Alpha 2.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIsoAlpha2(Builder $query, string $isoAlpha2): Builder
    {
        return $query->where('iso_alpha_2', $isoAlpha2);
    }

    /**
     * Find a model by iso Alpha 2, or if not found, retrieve all results.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereIsoAlpha2(Builder $query, string $isoAlpha2): Builder
    {
        return $query->orWhere('iso_alpha_2', $isoAlpha2);
    }
}
