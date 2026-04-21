<?php

namespace Lwwcas\LaravelCountries\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Lwwcas\LaravelCountries\Enum\LanguageEnum;
use Lwwcas\LaravelCountries\Providers\WCountriesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('translatable.locales', [
            LanguageEnum::EN_GB->formatFromConfig(),
            LanguageEnum::PT_PT->formatFromConfig(),
        ]);
        $this->app->setLocale(LanguageEnum::EN_GB->formatFromConfig());

        $this->createTables();
    }

    protected function getPackageProviders($app)
    {
        return [
            WCountriesServiceProvider::class,
        ];
    }

    public function createTables()
    {
        $migrationsPath = dirname(__DIR__).'/database/migrations';
        $this->loadMigrationsFrom($migrationsPath);
    }
}
