<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasWhereDomain
{
    /**
     * Find a country by domain (TLD).
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereDomain(Builder $query, string $domain): Builder
    {
        $domainInLowercase = Str::lower($domain);

        return $query->whereJsonContains('tld', $domainInLowercase);
    }

    /**
     * Find a country by multiple domains (TLD).
     *
     * @param  Builder<static>  $query
     * @param  string[]  $domains
     * @return Builder<static>
     */
    #[Scope]
    protected function whereDomains(Builder $query, array $domains): Builder
    {
        $domainsInLowercase = array_map(fn (string $domain) => Str::lower($domain), $domains);

        return $query->where(function (Builder $query) use ($domainsInLowercase) {
            foreach ($domainsInLowercase as $domain) {
                $query->whereJsonContains('tld', $domain);
            }
        });
    }

    /**
     * Find a country by alternative domain (TLD).
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereDomainAlternative(Builder $query, string $domain): Builder
    {
        $domainInLowercase = Str::lower($domain);

        return $query->whereJsonContains('alternative_tld', $domainInLowercase);
    }

    /**
     * Find a country by multiple alternative domains (TLD).
     *
     * @param  Builder<static>  $query
     * @param  string[]  $domains
     * @return Builder<static>
     */
    #[Scope]
    protected function whereDomainsAlternative(Builder $query, array $domains): Builder
    {
        $domainsInLowercase = array_map(fn (string $domain) => Str::lower($domain), $domains);

        return $query->where(function (Builder $query) use ($domainsInLowercase) {
            foreach ($domainsInLowercase as $domain) {
                $query->whereJsonContains('alternative_tld', $domain);
            }
        });
    }
}
