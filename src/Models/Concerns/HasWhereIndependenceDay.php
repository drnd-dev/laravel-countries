<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereIndependenceDay
{
    /**
     * Filter the query by independence day.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIndependenceDay(Builder $query, string $date): Builder
    {
        return $query->whereNotNull('independence_day')->whereDate('independence_day', $date);
    }

    /**
     * Filter the query by independence year.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIndependenceYear(Builder $query, int $year): Builder
    {
        return $query->whereNotNull('independence_day')->whereYear('independence_day', $year);
    }

    /**
     * Filter the query by independence dates between two dates.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIndependenceBetweenDates(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereNotNull('independence_day')
            ->whereBetween('independence_day', [$startDate, $endDate]);
    }

    /**
     * Filter the query by independence month.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIndependenceMonth(Builder $query, int $month): Builder
    {
        return $query->whereNotNull('independence_day')->whereMonth('independence_day', $month);
    }

    /**
     * Filter the query by independence dates before a certain date.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIndependenceBefore(Builder $query, string $date): Builder
    {
        return $query->whereNotNull('independence_day')->where('independence_day', '<', $date);
    }

    /**
     * Filter the query by independence dates after a certain date.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereIndependenceAfter(Builder $query, string $date): Builder
    {
        return $query->whereNotNull('independence_day')->where('independence_day', '>', $date);
    }
}
