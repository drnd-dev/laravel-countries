<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasTranslationGlobalScope
{
    /**
     * Retrieve a query builder without applying the 'translation' global scope.
     *
     * @return Builder<static>
     */
    public static function withNotTranslation(): Builder
    {
        /** @var Builder<static> $query */
        $query = static::withoutGlobalScope('translation');

        return $query;
    }
}
