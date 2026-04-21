<?php

use Illuminate\Support\Facades\Schema;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\PortugueseLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\LwwcasDatabaseSeeder;
use Lwwcas\LaravelCountries\Enum\LanguageEnum;
use Lwwcas\LaravelCountries\Models\CountryRegionTranslation;
use Lwwcas\LaravelCountries\Models\CountryTranslation;

it('shows error when tables do not exist and declines to run install', function () {
    Schema::dropIfExists('lc_countries');
    Schema::dropIfExists('lc_regions');

    $this->artisan('w-countries:languages')
        ->expectsConfirmation('Would you like to run the install?', 'no')
        ->assertExitCode(0);
});

it('cannot uninstall when no languages are in the database', function () {
    $this->artisan('w-countries:languages')
        ->expectsChoice('What would you like to do?', 'Uninstall', ['Install', 'Uninstall'])
        ->assertExitCode(0);
});

it('installs a language when english is already seeded', function () {
    $this->seed(LwwcasDatabaseSeeder::class);

    $this->artisan('w-countries:languages')
        ->expectsChoice('What would you like to do?', 'Install', ['Install', 'Uninstall'])
        ->expectsChoice(
            'Please select the languages you want to install:',
            ['Portuguese'],
            ['Arabic', 'Dutch', 'French', 'German', 'Italian', 'Latvian', 'Portuguese', 'Russian', 'Spanish']
        )
        ->expectsConfirmation('Do you want to choose again?', 'no')
        ->assertExitCode(0);

    expect(CountryTranslation::where('locale', LanguageEnum::PT_PT->formatFromConfig())->count())->toBeGreaterThan(0);
})->group('slow');

it('uninstalls a language when english and portuguese are seeded', function () {
    $this->seed(LwwcasDatabaseSeeder::class);
    $this->seed(PortugueseLanguageSeeder::class);

    $ptLocale = LanguageEnum::PT_PT->formatFromConfig();
    $ptTranslationsBefore = CountryTranslation::where('locale', $ptLocale)->count();

    $this->artisan('w-countries:languages')
        ->expectsChoice('What would you like to do?', 'Uninstall', ['Install', 'Uninstall'])
        ->expectsChoice(
            'Please select the languages you want to Uninstall:',
            ['Portuguese'],
            ['Portuguese']
        )
        ->expectsConfirmation('Do you want to choose again?', 'no')
        ->assertExitCode(0);

    expect($ptTranslationsBefore)->toBeGreaterThan(0)
        ->and(CountryTranslation::where('locale', $ptLocale)->count())->toBe(0)
        ->and(CountryRegionTranslation::where('locale', $ptLocale)->count())->toBe(0);
})->group('slow');
