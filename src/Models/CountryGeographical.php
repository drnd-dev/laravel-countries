<?php

namespace Lwwcas\LaravelCountries\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Lwwcas\LaravelCountries\Abstract\CountryModel;
use Lwwcas\LaravelCountries\Database\Factories\CountryGeographicalFactory;

/**
 * @property int $id
 * @property int $lc_country_id
 * @property string $type
 * @property string $features_type
 * @property array $properties
 * @property array $geometry
 * @property-read Country|null $country
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static CountryGeographicalFactory factory(...$parameters)
 *
 * @mixin CountryModel
 */
class CountryGeographical extends CountryModel
{
    /** @use HasFactory<CountryGeographicalFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lc_countries_geographical';

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
        'lc_country_id',
        'type',
        'features_type',
        'properties',
        'geometry',
    ];

    /**
     * Create a new factory instance for the model.
     */
    public static function newFactory(): CountryGeographicalFactory
    {
        return CountryGeographicalFactory::new();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'properties' => 'array',
            'geometry' => 'array',
        ];
    }

    /**
     * Get the country that owns the CountryGeographical
     *
     * @return HasOne<Country, $this>
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'lc_country_id');
    }

    /**
     * Get the geographical data as a GeoJSON feature collection.
     *
     * @return array{type: string, features: array{type: string, properties: array, geometry: array}}
     */
    public function getGeoData(): array
    {
        return [
            'type' => $this->type,
            'features' => [
                'type' => $this->features_type,
                'properties' => $this->properties,
                'geometry' => $this->geometry,
            ],
        ];
    }
}
