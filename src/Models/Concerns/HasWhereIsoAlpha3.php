<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereIsoAlpha3
{
    /**
     * Find a model by iso Alpha 3.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIsoAlpha3(Builder $query, string $isoAlpha3): Builder
    {
        return $query->where('iso_alpha_3', $isoAlpha3);
    }

    /**
     * Find a model by iso Alpha 3, or the given iso Alpha 3.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereIsoAlpha3(Builder $query, string $isoAlpha3): Builder
    {
        return $query->orWhere('iso_alpha_3', $isoAlpha3);
    }
}
