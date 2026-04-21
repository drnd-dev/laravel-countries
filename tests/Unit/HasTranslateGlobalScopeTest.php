<?php

use Illuminate\Database\Eloquent\Collection;
use Lwwcas\LaravelCountries\Database\Factories\CountryFactory;
use Lwwcas\LaravelCountries\Database\Factories\CountryRegionFactory;
use Lwwcas\LaravelCountries\Database\Factories\CountryRegionTranslationFactory;
use Lwwcas\LaravelCountries\Database\Factories\CountryTranslationFactory;
use Lwwcas\LaravelCountries\Enum\LanguageEnum;
use Lwwcas\LaravelCountries\Models\Country;
use Lwwcas\LaravelCountries\Models\CountryRegion;

it('should remove the translation global scope on Country Model', function () {
    CountryFactory::new()->count(5)->create();
    CountryTranslationFactory::new()->count(7)->create([
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    $queryWithoutTranslationScope = Country::withNotTranslation()->get();

    $countriesWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Collection::class);
    expect($countriesWithoutTranslation->count())->toBe(0);
});

it('should apply the translation global scope on Country Model', function () {
    CountryFactory::new()->count(5)->create();
    CountryTranslationFactory::new()->count(7)->create([
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    $queryWithoutTranslationScope = Country::all();

    $countriesWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Collection::class);
    expect($countriesWithoutTranslation->count())->toBe(12);
});

it('should remove the translation global scope on Region Model', function () {
    CountryRegionFactory::new()->count(5)->create();
    CountryRegionTranslationFactory::new()->count(7)->create([
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    $queryWithoutTranslationScope = CountryRegion::withNotTranslation()->get();

    $regionsWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Collection::class);
    expect($regionsWithoutTranslation->count())->toBe(0);
});

it('should apply the translation global scope on Region Model', function () {
    CountryRegionFactory::new()->count(5)->create();
    CountryRegionTranslationFactory::new()->count(7)->create([
        'locale' => LanguageEnum::EN_GB->formatFromConfig(),
    ]);

    $queryWithoutTranslationScope = CountryRegion::all();

    $regionsWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Collection::class);
    expect($regionsWithoutTranslation->count())->toBe(12);
});
