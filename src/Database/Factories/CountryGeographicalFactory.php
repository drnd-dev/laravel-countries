<?php

namespace Lwwcas\LaravelCountries\Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Lwwcas\LaravelCountries\Models\Country;
use Lwwcas\LaravelCountries\Models\CountryGeographical;

/**
 * @extends Factory<CountryGeographical>
 */
class CountryGeographicalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<CountryGeographical>
     */
    protected $model = CountryGeographical::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lc_country_id' => Country::factory(),
            'type' => 'FeatureCollection',
            'features_type' => 'Feature',
            'properties' => '{"cca2": "{'.fake()->languageCode().'}"}',
            'geometry' => '',
        ];
    }
}
