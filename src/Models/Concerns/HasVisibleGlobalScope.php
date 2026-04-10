<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasVisibleGlobalScope
{
    /**
     * Retrieve a query builder without applying the 'visible' global scope.
     *
     * @return Builder<static>
     */
    public static function withNotVisible(): Builder
    {
        /** @var Builder<static> $query */
        $query = static::withoutGlobalScope('is_visible');

        return $query;
    }
}
