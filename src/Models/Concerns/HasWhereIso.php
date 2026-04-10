<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereIso
{
    /**
     * Find a model by iso.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIso(Builder $query, string $iso): Builder
    {
        $fillable = $this->getFillable();

        if (in_array('iso_alpha_2', $fillable)) {
            $query->where('iso_alpha_2', $iso);
        }

        if (in_array('iso_alpha_3', $fillable)) {
            $query->orWhere('iso_alpha_3', $iso);
        }

        if (in_array('iso_numeric', $fillable)) {
            $query->orWhere('iso_numeric', $iso);
        }

        return $query;
    }

    /**
     * Find a model by iso.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereIso(Builder $query, string $iso): Builder
    {
        $fillable = $this->getFillable();

        if (in_array('iso_alpha_2', $fillable)) {
            $query->orWhere('iso_alpha_2', $iso);
        }

        if (in_array('iso_alpha_3', $fillable)) {
            $query->orWhere('iso_alpha_3', $iso);
        }

        if (in_array('iso_numeric', $fillable)) {
            $query->orWhere('iso_numeric', $iso);
        }

        return $query;
    }
}
