<?php

namespace Lwwcas\LaravelCountries\Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Lwwcas\LaravelCountries\Models\CountryRegion;

/**
 * @extends Factory<CountryRegion>
 */
class CountryRegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<CountryRegion>
     */
    protected $model = CountryRegion::class;

    protected array $regions = [
        'Africa',
        'America',
        'Asia',
        'Europe',
        'Oceania',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'iso_alpha_2' => fake()->countryCode().rand(1, 9999),
            'icao' => Str::upper(fake()->randomLetter().fake()->randomLetter()),
            'iucn' => substr(fake()->randomElement($this->regions).' '.fake()->word(), 0, 10),
            'tdwg' => substr(fake()->word(), 0, 10),
            'is_visible' => true,
        ];
    }
}
