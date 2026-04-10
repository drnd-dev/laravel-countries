<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

trait HasFlagColorsGetters
{
    /**
     * Return an array of a country's flag colors.
     *
     * This will return the same value as `getFlagColorsName()`.
     */
    public function getFlagColors(): array
    {
        return $this->getFlagColorsName();
    }

    /**
     * Return an array of a country's flag colors as strings.
     *
     * This can be used to get the color names of a country's flag.
     */
    public function getFlagColorsName(): array
    {
        return $this->flag_colors ?: [];
    }

    /**
     * Return an array of a country's flag colors as web-safe color codes.
     *
     * This can be used to get the color codes of a country's flag in web-safe
     * format.
     */
    public function getFlagColorsWeb(): array
    {
        return $this->flag_colors_web ?: [];
    }

    /**
     * Return an array of a country's flag colors as contrast colors.
     *
     * This can be used to get the contrast colors of a country's flag.
     */
    public function getFlagColorsContrast(): array
    {
        return $this->flag_colors_contrast ?: [];
    }

    /**
     * Return an array of a country's flag colors as hex color codes.
     *
     * This can be used to get the color codes of a country's flag in hex format.
     */
    public function getFlagColorsHex(): array
    {
        return $this->flag_colors_hex ?: [];
    }

    /**
     * Return an array of a country's flag colors as RGB color codes.
     *
     * This can be used to get the color codes of a country's flag in RGB format.
     */
    public function getFlagColorsRgb(): array
    {
        return $this->flag_colors_rgb ?: [];
    }

    /**
     * Return an array of a country's flag colors as CMYK color codes.
     *
     * This can be used to get the color codes of a country's flag in CMYK format.
     */
    public function getFlagColorsCmyk(): array
    {
        return $this->flag_colors_cmyk ?: [];
    }

    /**
     * Return an array of a country's flag colors as HSL color codes.
     *
     * This can be used to get the color codes of a country's flag in HSL format.
     */
    public function getFlagColorsHsl(): array
    {
        return $this->flag_colors_hsl ?: [];
    }

    /**
     * Return an array of a country's flag colors as HSV color codes.
     *
     * This can be used to get the color codes of a country's flag in HSV format.
     */
    public function getFlagColorsHsv(): array
    {
        return $this->flag_colors_hsv ?: [];
    }

    /**
     * Return an array of a country's flag colors as Pantone color codes.
     *
     * This can be used to get the color codes of a country's flag in Pantone format.
     */
    public function getFlagColorsPantone(): array
    {
        return $this->flag_colors_pantone ?: [];
    }
}
