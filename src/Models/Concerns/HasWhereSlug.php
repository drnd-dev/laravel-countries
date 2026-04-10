<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasWhereSlug
{
    /**
     * Find a model by slug.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereSlug(Builder $query, string $slug, ?string $locale = null): Builder
    {
        $slug = Str::slug($slug);

        $query->whereTranslation('slug', $slug, $locale);

        return $query;
    }

    /**
     * Find a model by slug (or where).
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function orWhereSlug(Builder $query, string $slug, ?string $locale = null): Builder
    {
        $slug = Str::slug($slug);

        $query->orWhereTranslation('slug', $slug, $locale);

        return $query;
    }
}
