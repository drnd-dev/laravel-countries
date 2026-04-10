<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWherePhoneCode
{
    /**
     * Find a country by international phone code.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function wherePhoneCode(Builder $query, string $internationalPhone): Builder
    {
        return $query->where('international_phone', $internationalPhone);
    }

    /**
     * Filter the query by the international phone code or the given value.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWherePhoneCode(Builder $query, string $internationalPhone): Builder
    {
        return $query->orWhere('international_phone', $internationalPhone);
    }
}
