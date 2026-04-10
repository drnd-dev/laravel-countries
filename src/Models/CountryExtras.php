<?php

namespace Lwwcas\LaravelCountries\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Lwwcas\LaravelCountries\Abstract\CountryModel;
use Lwwcas\LaravelCountries\Database\Factories\CountryExtrasFactory;

/**
 * @property int $id
 * @property int $lc_country_id
 * @property string|null $national_sport
 * @property string|null $cybersecurity_agency
 * @property array|null $popular_technologies
 * @property array|null $internet
 * @property array|null $religions
 * @property array|null $international_organizations
 * @property-read Country|null $country
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static CountryExtrasFactory factory(...$parameters)
 *
 * @mixin CountryModel
 */
class CountryExtras extends CountryModel
{
    /** @use HasFactory<CountryExtrasFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lc_countries_extras';

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
        'national_sport',
        'cybersecurity_agency',
        'popular_technologies',
        'internet',
        'religions',
        'international_organizations',
    ];

    /**
     * Create a new factory instance for the model.
     */
    public static function newFactory(): CountryExtrasFactory
    {
        return CountryExtrasFactory::new();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'popular_technologies' => 'array',
            'international_organizations' => 'array',
            'religions' => 'array',
            'internet' => 'array',
        ];
    }

    /**
     * Get the country that owns the CountryExtras
     *
     * @return HasOne<Country, $this>
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'lc_country_id');
    }
}
