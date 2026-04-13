<?php

namespace Lwwcas\LaravelCountries\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Lwwcas\LaravelCountries\Abstract\CountryModel;
use Lwwcas\LaravelCountries\Database\Factories\CountryFactory;
use Lwwcas\LaravelCountries\Models\Concerns\HasCountriesList;
use Lwwcas\LaravelCountries\Models\Concerns\HasFlagColorsGetters;
use Lwwcas\LaravelCountries\Models\Concerns\HasFlagEmojiGetters;
use Lwwcas\LaravelCountries\Models\Concerns\HasTranslationGlobalScope;
use Lwwcas\LaravelCountries\Models\Concerns\HasVisibleGlobalScope;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereBorders;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereCurrency;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereDomain;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereFlagColors;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIndependenceDay;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIso;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIsoAlpha2;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIsoAlpha3;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIsoNumeric;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereLanguages;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereName;
use Lwwcas\LaravelCountries\Models\Concerns\HasWherePhoneCode;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereSlug;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereStatistics;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereWmo;
use Lwwcas\LaravelCountries\Models\Concerns\VisibleAttributes;
use Lwwcas\LaravelCountries\Trait\WithCoordinatesBootstrap;
use Lwwcas\LaravelCountries\Trait\WithFlagColorBootstrap;

/**
 * @property int $id
 * @property int $lc_region_id
 * @property string $uid
 * @property string $official_name
 * @property string|null $capital
 * @property string $iso_alpha_2
 * @property string $iso_alpha_3
 * @property int|null $iso_numeric
 * @property string|null $international_phone
 * @property string|null $geoname_id
 * @property string|null $wmo
 * @property Carbon|null $independence_day
 * @property string|null $population
 * @property string|null $area
 * @property string|null $gdp
 * @property array|null $languages
 * @property array|null $tld
 * @property array|null $alternative_tld
 * @property array|null $borders
 * @property array|null $timezones
 * @property array|null $currency
 * @property array|null $flag_emoji
 * @property array|null $flag_colors
 * @property array|null $flag_colors_web
 * @property array|null $flag_colors_contrast
 * @property array|null $flag_colors_hex
 * @property array|null $flag_colors_rgb
 * @property array|null $flag_colors_cmyk
 * @property array|null $flag_colors_hsl
 * @property array|null $flag_colors_hsv
 * @property array|null $flag_colors_pantone
 * @property bool $is_visible
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read CountryRegion|null $region
 * @property-read CountryGeographical|null $geographical
 * @property-read CountryExtras|null $extras
 * @property-read CountryCoordinates|null $coordinates
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static CountryFactory factory(...$parameters)
 *
 * @mixin CountryModel
 */
class Country extends CountryModel
{
    /** @use HasFactory<CountryFactory> */
    use HasCountriesList,
        HasFactory,
        HasFlagColorsGetters,
        HasFlagEmojiGetters,
        HasTranslationGlobalScope,
        HasVisibleGlobalScope,
        HasWhereBorders,
        HasWhereCurrency,
        HasWhereDomain,
        HasWhereFlagColors,
        HasWhereIndependenceDay,
        HasWhereIso,
        HasWhereIsoAlpha2,
        HasWhereIsoAlpha3,
        HasWhereIsoNumeric,
        HasWhereLanguages,
        HasWhereName,
        HasWherePhoneCode,
        HasWhereSlug,
        HasWhereStatistics,
        HasWhereWmo,
        Translatable,
        VisibleAttributes,
        WithCoordinatesBootstrap,
        WithFlagColorBootstrap;

    public string $translationModel = CountryTranslation::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lc_countries';

    public array $translatedAttributes = [
        'slug',
        'name',
    ];

    public string $translationForeignKey = 'lc_country_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uid', // Unique identifier (ULID) for the country.
        'lc_region_id', // Foreign key linking the country to a specific region.

        'official_name', // The official name of the country (e.g., "United States of America").
        'capital', // The capital city of the country.
        'iso_alpha_2', // ISO 3166-1 alpha-2 country code (e.g., "US" for the United States).
        'iso_alpha_3', // ISO 3166-1 alpha-3 country code (e.g., "USA" for the United States).
        'iso_numeric', // ISO 3166-1 numeric country code (e.g., "840" for the United States).

        'international_phone', // The country’s international dialing code (e.g., +1 for the United States).
        'geoname_id', // The GeoNames geographical database ID for the country https://www.geonames.org/
        'wmo', // Country abbreviations by the World Meteorological Organization (WMO).
        'independence_day', // Year of the country's independence, if applicable.

        'population', // The population of the country.
        'area', // The area of the country in square kilometers (km²).
        'gdp', // The Gross Domestic Product (GDP) of the country in billions of USD.

        'languages', // Official languages spoken in the country.
        'tld', // Top-level domain (e.g., ".us" for the United States).
        'alternative_tld', // Alternative top-level domains (e.g., country-specific or alternative domain suffixes).
        'borders', // List of bordering countries (if any).
        'timezones', // The country's time zones, including main and additional ones.
        'currency', // Information about the country's currency, including name, symbol, and units.

        'flag_emoji', // The emoji representation of the country's flag.
        'flag_colors', // Base colors of the flag.
        'flag_colors_web', // Web-safe color names for the flag.
        'flag_colors_contrast', // Contrast colors for improved readability on the flag.
        'flag_colors_hex', // Hexadecimal color codes for the flag.
        'flag_colors_rgb', // RGB (Red, Green, Blue) color values for the flag.
        'flag_colors_cmyk', // CMYK (Cyan, Magenta, Yellow, Black) color values for the flag.
        'flag_colors_hsl', // HSL (Hue, Saturation, Lightness) color values for the flag.
        'flag_colors_hsv', // HSV (Hue, Saturation, Value) color values for the flag.
        'flag_colors_pantone', // Pantone color codes for the flag.

        'is_visible', // Boolean flag indicating whether the country is visible in the application.
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'is_visible' => true,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'languages' => 'array',
            'tld' => 'array',
            'alternative_tld' => 'array',
            'borders' => 'array',
            'timezones' => 'array',
            'currency' => 'array',

            'flag_emoji' => 'array',
            'flag_colors' => 'array',
            'flag_colors_web' => 'array',
            'flag_colors_contrast' => 'array',
            'flag_colors_hex' => 'array',
            'flag_colors_rgb' => 'array',
            'flag_colors_cmyk' => 'array',
            'flag_colors_hsl' => 'array',
            'flag_colors_hsv' => 'array',
            'flag_colors_pantone' => 'array',

            'independence_day' => 'date:Y-m-d',

            'is_visible' => 'boolean',
        ];
    }

    /**
     * Create a new factory instance for the model.
     */
    public static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }

    public static function booted(): void
    {
        self::creating(function (Country $model) {
            $model->uid = (string) Str::ulid();
        });
    }

    protected static function booting(): void
    {
        // Applying a global scope to always filter countries where 'visible' is true
        static::addGlobalScope('is_visible', function (Builder $builder) {
            $builder->where('is_visible', true);
        });

        // Apply a global scope to always eager load the translations
        static::addGlobalScope('translation', function (Builder $builder) {
            $builder->withTranslation();
        });
    }

    /**
     * Interact with the user's first name.
     *
     * @return Attribute<string, never>
     */
    protected function officialName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::ucfirst($value),
        );
    }

    /**
     * Mutator for the iso_alpha_2 attribute.
     *
     * It ensures the ISO Alpha 2 code is always uppercased.
     *
     * @return Attribute<string, never>
     */
    protected function isoAlpha2(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::upper($value),
        );
    }

    /**
     * Mutator for the iso_alpha_3 attribute.
     *
     * It ensures the ISO Alpha 3 code is always uppercased.
     *
     * @return Attribute<string, never>
     */
    protected function isoAlpha3(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::upper($value),
        );
    }

    /**
     * Get the region that owns the Country
     *
     * @return BelongsTo<CountryRegion, $this>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(CountryRegion::class, 'lc_region_id');
    }

    /**
     * Get the geographical data for the country.
     *
     * @return HasOne<CountryGeographical, $this>
     */
    public function geographical(): HasOne
    {
        return $this->hasOne(CountryGeographical::class, 'lc_country_id');
    }

    /**
     * Get the extra data for the country.
     *
     * @return HasOne<CountryExtras, $this>
     */
    public function extras(): HasOne
    {
        return $this->hasOne(CountryExtras::class, 'lc_country_id');
    }

    /**
     * Get the coordinates for the country.
     *
     * @return HasOne<CountryCoordinates, $this>
     */
    public function coordinates(): HasOne
    {
        return $this->hasOne(CountryCoordinates::class, 'lc_country_id');
    }

    /**
     * Find a country by UIDs.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereUid(Builder $query, string $uid): Builder
    {
        return $query->where('uid', $uid);
    }

    /**
     * Find a country by UIDs or where the country's UIDs is a given value.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereUid(Builder $query, string $uid): Builder
    {
        return $query->orWhere('uid', $uid);
    }

    /**
     * Find a country by official name.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereOficialName(Builder $query, string $officialName): Builder
    {
        return $query->where('official_name', $officialName);
    }

    /**
     * Find a country by official name with OR operator.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereOficialName(Builder $query, string $officialName): Builder
    {
        return $query->orWhere('official_name', $officialName);
    }

    /**
     * Find a country by official name with LIKE condition.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereOficialNameLike(Builder $query, string $officialName): Builder
    {
        return $query->whereLike('official_name', '%'.$officialName.'%');
    }

    /**
     * Find a country by official name with LIKE condition and OR operator.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereOficialNameLike(Builder $query, string $officialName): Builder
    {
        return $query->orWhereLike('official_name', '%'.$officialName.'%');
    }

    /**
     * Find a country by Geoname ID.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereGeoname(Builder $query, int $geonameId): Builder
    {
        return $query->where('geoname_id', $geonameId);
    }

    /**
     * Find a country by Geoname ID with OR operator.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereGeoname(Builder $query, int $geonameId): Builder
    {
        return $query->orWhere('geoname_id', $geonameId);
    }

    /**
     * Get the geographical data as a GeoJSON feature collection.
     */
    public function getGeoData(): array
    {
        return $this->geographical()->first()?->getGeoData() ?? [];
    }
}
