<?php

namespace Lwwcas\LaravelCountries\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Lwwcas\LaravelCountries\Abstract\CountryModel;
use Lwwcas\LaravelCountries\Database\Factories\CountryCoordinatesFactory;

/**
 * @property int $id
 * @property int $lc_country_id
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $degrees_with_decimal
 * @property string|null $degrees_minutes_seconds
 * @property string|null $degrees_and_decimal_minutes
 * @property array|null $gps
 * @property-read Country|null $country
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static CountryCoordinatesFactory factory(...$parameters)
 *
 * @mixin CountryModel
 */
class CountryCoordinates extends CountryModel
{
    /** @use HasFactory<CountryCoordinatesFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lc_countries_coordinates';

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
        'latitude',
        'longitude',
        'degrees_with_decimal',
        'degrees_minutes_seconds',
        'degrees_and_decimal_minutes',
        'gps',
    ];

    /**
     * Create a new factory instance for the model.
     */
    public static function newFactory(): CountryCoordinatesFactory
    {
        return CountryCoordinatesFactory::new();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gps' => 'array',
        ];
    }

    /**
     * Get the country that owns the CountryCoordinates
     *
     * @return HasOne<Country, $this>
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'lc_country_id');
    }
}
