<?php

use Illuminate\Support\Facades\App;
use Lwwcas\LaravelCountries\Database\Factories\CountryFactory;
use Lwwcas\LaravelCountries\Database\Factories\CountryRegionFactory;
use Lwwcas\LaravelCountries\Database\Factories\CountryRegionTranslationFactory;
use Lwwcas\LaravelCountries\Database\Factories\CountryTranslationFactory;
use Lwwcas\LaravelCountries\Enum\LanguageEnum;
use Lwwcas\LaravelCountries\Models\Country;
use Lwwcas\LaravelCountries\Models\CountryRegion;

it('should can filters countries by Slug', function () {
    CountryTranslationFactory::new()->create([
        'name' => 'Brazil',
        'slug' => 'brazil',
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    CountryFactory::new()->count(5)->create();

    $country = Country::query()->whereSlug('brazil')->first();

    expect($country)->toBeInstanceOf(Country::class);
    expect($country->slug)->toEqual('brazil');
    expect($country->slug)->toBeString();
});

it('should can filters countries by Slug on specific locale', function () {
    $country = CountryFactory::new()->create([
        'official_name' => 'Brasil',
    ]);

    CountryTranslationFactory::new()->create([
        'lc_country_id' => $country->id,
        'name' => 'Brazil EN',
        'slug' => 'brazil-en',
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    CountryTranslationFactory::new()->create([
        'lc_country_id' => $country->id,
        'name' => 'Brazil IT',
        'slug' => 'brazil-it',
        'locale' => LanguageEnum::IT_IT->formatFromConfig(),
    ]);

    App::setLocale(LanguageEnum::EN_GB->formatFromConfig());
    $country = Country::query()->whereSlug('brazil-en')->first();

    expect($country)->toBeInstanceOf(Country::class);
    expect($country->slug)->toBeString();
    expect($country->slug)->toEqual('brazil-en');

    App::setLocale(LanguageEnum::IT_IT->formatFromConfig());
    $country = Country::query()->whereSlug('brazil-it')->first();

    expect($country)->toBeInstanceOf(Country::class);
    expect($country->slug)->toBeString();
    expect($country->slug)->toEqual('brazil-it');

});

it('should can filters regions by Slug', function () {
    CountryRegionTranslationFactory::new()->create([
        'name' => 'Europe',
        'slug' => 'europe',
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    CountryRegionFactory::new()->count(5)->create();

    $region = CountryRegion::query()->whereSlug('europe')->first();

    expect($region)->toBeInstanceOf(CountryRegion::class);
    expect($region->slug)->toEqual('europe');
    expect($region->slug)->toBeString();
});

it('should can filters regions by Slug on specific locale', function () {
    $region = CountryFactory::new()->create();

    CountryRegionTranslationFactory::new()->create([
        'lc_region_id' => $region->id,
        'name' => 'Europe EN',
        'slug' => 'europe-en',
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    CountryRegionTranslationFactory::new()->create([
        'lc_region_id' => $region->id,
        'name' => 'Europe IT',
        'slug' => 'europe-it',
        'locale' => LanguageEnum::IT_IT->formatFromConfig(),
    ]);

    App::setLocale(LanguageEnum::EN_GB->formatFromConfig());
    $region = CountryRegion::query()->whereSlug('europe-en')->first();

    expect($region)->toBeInstanceOf(CountryRegion::class);
    expect($region->slug)->toBeString();
    expect($region->slug)->toEqual('europe-en');

    App::setLocale(LanguageEnum::IT_IT->formatFromConfig());
    $region = CountryRegion::query()->whereSlug('europe-en')->first();

    expect($region)->toBeInstanceOf(CountryRegion::class);
    expect($region->slug)->toBeString();
    expect($region->slug)->toEqual('europe-it');
});
