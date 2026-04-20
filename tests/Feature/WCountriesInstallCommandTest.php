<?php

use Illuminate\Support\Facades\Schema;
use Lwwcas\LaravelCountries\Models\Country;
use Lwwcas\LaravelCountries\Models\CountryRegion;

it('runs full install when migrations are confirmed', function () {
    $this->artisan('w-countries:install')
        ->expectsConfirmation('Would you like to run the migrations now?', 'yes')
        ->expectsChoice(
            'Please select the languages you want to install:',
            ['None'],
            ['None', 'All', 'Arabic', 'Dutch', 'French', 'German', 'Italian', 'Latvian', 'Portuguese', 'Russian', 'Spanish']
        )
        ->expectsConfirmation('Do you want to choose again?', 'no')
        ->expectsConfirmation('Would you like to star our repo on GitHub?', 'no')
        ->assertExitCode(1);

    expect(Schema::hasTable('lc_countries'))->toBeTrue()
        ->and(Schema::hasTable('lc_regions'))->toBeTrue()
        ->and(CountryRegion::count())->toBeGreaterThan(0)
        ->and(Country::count())->toBeGreaterThan(0);
})->group('slow');
