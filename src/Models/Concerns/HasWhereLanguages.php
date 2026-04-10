<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasWhereLanguages
{
    /**
     * Find a country by language.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereLanguage(Builder $query, string $language): Builder
    {
        $languageInLowercase = Str::lower($language);

        return $query->whereJsonContains('languages', $languageInLowercase);
    }

    /**
     * Find a country by multiple languages.
     *
     * @param  Builder<static>  $query
     * @param  string[]  $languages
     * @return Builder<static>
     */
    #[Scope]
    protected function whereLanguages(Builder $query, array $languages): Builder
    {
        $languagesInLowercase = array_map(fn (string $lang) => Str::lower($lang), $languages);

        return $query->where(function (Builder $query) use ($languagesInLowercase) {
            foreach ($languagesInLowercase as $language) {
                $query->whereJsonContains('languages', $language);
            }
        });
    }
}
