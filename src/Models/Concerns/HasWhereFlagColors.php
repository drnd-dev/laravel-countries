<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasWhereFlagColors
{
    /**
     * Scope a query to only include countries that have a given flag color.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $name
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColor(Builder $query, string|array $name): Builder
    {
        if (is_array($name)) {
            $namesInTitle = array_map(fn (string $n) => Str::title($n), $name);

            return $this->whereFlagByManyColors($query, $namesInTitle, 'flag_colors');
        }

        return $this->whereFlagByOneColor($query, Str::title($name), 'flag_colors');
    }

    /**
     * Scope a query to only include countries that have a given flag color in Web
     * color notation.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $name
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorWeb(Builder $query, string|array $name): Builder
    {
        if (is_array($name)) {
            $namesInLowercase = array_map(fn (string $n) => Str::lower($n), $name);

            return $this->whereFlagByManyColors($query, $namesInLowercase, 'flag_colors_web');
        }

        return $this->whereFlagByOneColor($query, Str::lower($name), 'flag_colors_web');
    }

    /**
     * Scope a query to only include countries that have a given contrast color.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $contrast
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagContrast(Builder $query, string|array $contrast): Builder
    {
        if (is_array($contrast)) {
            return $this->whereFlagByManyColors($query, $contrast, 'flag_colors_contrast');
        }

        return $this->whereFlagByOneColor($query, $contrast, 'flag_colors_contrast');
    }

    /**
     * Scope a query to only include countries that have a given flag color in Hex.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $hex
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorHex(Builder $query, string|array $hex): Builder
    {
        if (is_array($hex)) {
            return $this->whereFlagByManyColors($query, $hex, 'flag_colors_hex');
        }

        return $this->whereFlagByOneColor($query, $hex, 'flag_colors_hex');
    }

    /**
     * Scope a query to only include countries that have a given flag color in RGB.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $rgb
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorRGB(Builder $query, string|array $rgb): Builder
    {
        if (is_array($rgb)) {
            return $this->whereFlagByManyColors($query, $rgb, 'flag_colors_rgb');
        }

        return $this->whereFlagByOneColor($query, $rgb, 'flag_colors_rgb');
    }

    /**
     * Scope a query to only include countries that have a given flag color in CMYK.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $cmyk
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorCMYK(Builder $query, string|array $cmyk): Builder
    {
        if (is_array($cmyk)) {
            return $this->whereFlagByManyColors($query, $cmyk, 'flag_colors_cmyk');
        }

        return $this->whereFlagByOneColor($query, $cmyk, 'flag_colors_cmyk');
    }

    /**
     * Scope a query to only include countries that have a given flag color in HSL.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $hsl
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorHSL(Builder $query, string|array $hsl): Builder
    {
        if (is_array($hsl)) {
            return $this->whereFlagByManyColors($query, $hsl, 'flag_colors_hsl');
        }

        return $this->whereFlagByOneColor($query, $hsl, 'flag_colors_hsl');
    }

    /**
     * Scope a query to only include countries that have a given flag color in HSV.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $hsv
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorHSV(Builder $query, string|array $hsv): Builder
    {
        if (is_array($hsv)) {
            return $this->whereFlagByManyColors($query, $hsv, 'flag_colors_hsv');
        }

        return $this->whereFlagByOneColor($query, $hsv, 'flag_colors_hsv');
    }

    /**
     * Scope a query to only include countries that have a given Pantone color code.
     *
     * @param  Builder<static>  $query
     * @param  string|string[]  $pantone
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagColorPantone(Builder $query, string|array $pantone): Builder
    {
        if (is_array($pantone)) {
            return $this->whereFlagByManyColors($query, $pantone, 'flag_colors_pantone');
        }

        return $this->whereFlagByOneColor($query, $pantone, 'flag_colors_pantone');
    }

    /**
     * Filter countries that match a single color value in the given column.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagByOneColor(Builder $query, string $name, string $column): Builder
    {
        return $query->whereLike($column, '%'.$name.'%');
    }

    /**
     * Filter countries that match any of the given color values in the given column.
     *
     * @param  Builder<static>  $query
     * @param  string[]  $names
     * @return Builder<static>
     */
    #[Scope]
    protected function whereFlagByManyColors(Builder $query, array $names, string $column): Builder
    {
        return $query->where(function (Builder $query) use ($names, $column) {
            foreach ($names as $color) {
                $query->orWhereLike($column, '%'.$color.'%');
            }
        });
    }
}
