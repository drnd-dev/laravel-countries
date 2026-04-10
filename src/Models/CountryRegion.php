<?php

namespace Lwwcas\LaravelCountries\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lwwcas\LaravelCountries\Abstract\CountryModel;
use Lwwcas\LaravelCountries\Database\Factories\CountryRegionFactory;
use Lwwcas\LaravelCountries\Models\Concerns\HasTranslationGlobalScope;
use Lwwcas\LaravelCountries\Models\Concerns\HasVisibleGlobalScope;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIso;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereIsoAlpha2;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereName;
use Lwwcas\LaravelCountries\Models\Concerns\HasWhereSlug;
use Lwwcas\LaravelCountries\Models\Concerns\VisibleAttributes;

/**
 * @property int $id
 * @property string $iso_alpha_2
 * @property string $icao
 * @property string $iucn
 * @property string $tdwg
 * @property bool $is_visible
 * @property-read Collection<int, Country> $countries
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static CountryRegionFactory factory(...$parameters)
 * @method static Builder<static>|CountryRegion listsTranslations(string $translationField)
 * @method static Builder<static>|CountryRegion notTranslatedIn(?string $locale = null)
 * @method static Builder<static>|CountryRegion orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static Builder<static>|CountryRegion orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static Builder<static>|CountryRegion orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static Builder<static>|CountryRegion translated()
 * @method static Builder<static>|CountryRegion translatedIn(?string $locale = null)
 * @method static Builder<static>|CountryRegion whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static Builder<static>|CountryRegion whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static Builder<static>|CountryRegion withTranslation(?string $locale = null)
 * @method static Builder<static>|CountryRegion whereICAO(string $icao)
 * @method static Builder<static>|CountryRegion orWhereICAO(string $icao)
 * @method static Builder<static>|CountryRegion whereIUCN(string $iucn)
 * @method static Builder<static>|CountryRegion orWhereIUCN(string $iucn)
 * @method static Builder<static>|CountryRegion whereTDWG(string $tdwg)
 * @method static Builder<static>|CountryRegion orWhereTDWG(string $tdwg)
 * @method static Builder<static>|CountryRegion whereIso(string $iso)
 * @method static Builder<static>|CountryRegion orWhereIso(string $iso)
 * @method static Builder<static>|CountryRegion whereIsoAlpha2(string $isoAlpha2)
 * @method static Builder<static>|CountryRegion orWhereIsoAlpha2(string $isoAlpha2)
 * @method static Builder<static>|CountryRegion whereName(string $name)
 * @method static Builder<static>|CountryRegion orWhereName(string $name)
 * @method static Builder<static>|CountryRegion whereNameLike(string $name)
 * @method static Builder<static>|CountryRegion orWhereNameLike(string $name)
 * @method static Builder<static>|CountryRegion orderByName(string $sortMethod = 'asc')
 * @method static Builder<static>|CountryRegion whereSlug(string $slug)
 * @method static Builder<static>|CountryRegion orWhereSlug(string $slug)
 *
 * @mixin CountryModel
 */
class CountryRegion extends CountryModel
{
    /** @use HasFactory<CountryRegionFactory> */
    use HasFactory,
        HasTranslationGlobalScope,
        HasVisibleGlobalScope,
        HasWhereIso,
        HasWhereIsoAlpha2,
        HasWhereName,
        HasWhereSlug,
        Translatable,
        VisibleAttributes;

    public string $translationModel = CountryRegionTranslation::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lc_regions';

    /* Mass Translatable Assignment */
    public array $translatedAttributes = [
        'slug',
        'name',
    ];

    /* Translatable ForeignKey */
    public string $translationForeignKey = 'lc_region_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'iso_alpha_2', // The ISO 3166-1 alpha-2 region code (e.g., "US" for United States).
        'icao',        // The ICAO (International Civil Aviation Organization) region code for aviation purposes.
        'iucn',        // The IUCN (International Union for Conservation of Nature) region code for conservation data.
        'tdwg',        // The TDWG (World Geographical Scheme for Recording Plant Distributions) code, used in biodiversity studies.
        'is_visible',     // A boolean flag indicating if the region is visible in the queries.
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
     * Create a new factory instance for the model.
     */
    public static function newFactory(): CountryRegionFactory
    {
        return CountryRegionFactory::new();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    /**
     * Perform any actions required before the model boots.
     */
    protected static function booting(): void
    {
        // Applying a global scope to always filter countries where 'is_visible' is true
        static::addGlobalScope('is_visible', function (Builder $builder) {
            $builder->where('is_visible', true);
        });

        // Apply a global scope to always eager load the translations
        static::addGlobalScope('translation', function (Builder $builder) {
            $builder->withTranslation();
        });
    }

    /**
     * Get the countries that are located in this region.
     *
     * @return HasMany<Country, $this>
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class, 'lc_region_id');
    }

    /**
     * Filter the query by the ICAO (International Civil Aviation Organization) region code
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereICAO(Builder $query, string $icao): Builder
    {
        return $query->where('icao', $icao);
    }

    /**
     * Filter the query by the ICAO (International Civil Aviation Organization) region code, adding the filter with an "or where" clause
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereICAO(Builder $query, string $icao): Builder
    {
        return $query->orWhere('icao', $icao);
    }

    /**
     * Filter the query by the IUCN (International Union for Conservation of Nature) region code
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereIUCN(Builder $query, string $iucn): Builder
    {
        return $query->where('iucn', $iucn);
    }

    /**
     * Filter the query by the IUCN (International Union for Conservation of Nature) region code, adding the filter with an "or where" clause
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereIUCN(Builder $query, string $iucn): Builder
    {
        return $query->orWhere('iucn', $iucn);
    }

    /**
     * Filter the query by the TDWG (Taxonomic Databases Working Group) region code
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function whereTDWG(Builder $query, string $tdwg): Builder
    {
        return $query->where('tdwg', $tdwg);
    }

    /**
     * Filter the query by the TDWG (Taxonomic Databases Working Group) region code, adding the filter with an "or where" clause
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    public function orWhereTDWG(Builder $query, string $tdwg): Builder
    {
        return $query->orWhere('tdwg', $tdwg);
    }
}
