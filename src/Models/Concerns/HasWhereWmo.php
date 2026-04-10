<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereWmo
{
    /**
     * Find a country by WMO (World Meteorological Organization) code.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereWmo(Builder $query, string $wmo): Builder
    {
        return $query->where('wmo', $wmo);
    }

    /**
     * Find a country by WMO (World Meteorological Organization) code.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereWmoCode(Builder $query, string $wmo): Builder
    {
        return $query->whereWmo($wmo);
    }

    /**
     * Find a country by WMO (World Meteorological Organization) code.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereWorldMeteorologicalOrganizationCode(Builder $query, string $wmo): Builder
    {
        return $query->whereWmo($wmo);
    }
}
