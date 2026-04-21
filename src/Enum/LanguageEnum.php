<?php

namespace Lwwcas\LaravelCountries\Enum;

use Lwwcas\LaravelCountries\Contracts\LanguageSeedContract;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\ArabicLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\DutchLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\FrenchLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\GermanLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\ItalianLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\LatvianLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\PortugueseLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\RussianLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\Languages\SpanishLanguageSeeder;
use Lwwcas\LaravelCountries\Database\Seeders\LwwcasDatabaseSeeder;

enum LanguageEnum: string
{
    case EN_GB = 'en_GB';
    case AR_SA = 'ar_SA';
    case DE_DE = 'de_DE';
    case ES_ES = 'es_ES';
    case FR_FR = 'fr_FR';
    case IT_IT = 'it_IT';
    case LV_LV = 'lv_LV';
    case NL_NL = 'nl_NL';
    case PT_PT = 'pt_PT';
    case RU_RU = 'ru_RU';

    public function isoAlpha2(): string
    {
        return match ($this) {
            self::EN_GB => 'en',
            self::AR_SA => 'ar',
            self::DE_DE => 'de',
            self::ES_ES => 'es',
            self::FR_FR => 'fr',
            self::IT_IT => 'it',
            self::LV_LV => 'lv',
            self::NL_NL => 'nl',
            self::PT_PT => 'pt',
            self::RU_RU => 'ru',
        };
    }

    public function localeHyphen(): string
    {
        return str_replace('_', '-', $this->value);
    }

    public function title(): string
    {
        return match ($this) {
            LanguageEnum::EN_GB => 'English',
            LanguageEnum::AR_SA => 'Arabic',
            LanguageEnum::NL_NL => 'Dutch',
            LanguageEnum::FR_FR => 'French',
            LanguageEnum::DE_DE => 'German',
            LanguageEnum::IT_IT => 'Italian',
            LanguageEnum::LV_LV => 'Latvian',
            LanguageEnum::PT_PT => 'Portuguese',
            LanguageEnum::RU_RU => 'Russian',
            LanguageEnum::ES_ES => 'Spanish',
        };
    }

    public static function defaultLanguage(): self
    {
        return self::EN_GB;
    }

    public function format(LocaleCodeFormatEnum $formatEnum): string
    {
        return match ($formatEnum) {
            LocaleCodeFormatEnum::ISO_ALPHA_2 => $this->isoAlpha2(),
            LocaleCodeFormatEnum::LOCALE_UNDERSCORE => $this->value,
            LocaleCodeFormatEnum::LOCALE_HYPHEN => $this->localeHyphen(),
        };
    }

    public function formatFromConfig(): string
    {
        $value = config('w-countries.locale_code_format', LocaleCodeFormatEnum::ISO_ALPHA_2);

        $formatEnum = $value instanceof LocaleCodeFormatEnum ? $value : LocaleCodeFormatEnum::from($value);

        return $this->format($formatEnum);
    }

    /**
     * @return class-string<LanguageSeedContract>
     */
    public function seederClassString(): string
    {
        /** @var class-string<LanguageSeedContract> $classString */
        $classString = match ($this) {
            self::EN_GB => LwwcasDatabaseSeeder::class,
            self::AR_SA => ArabicLanguageSeeder::class,
            self::DE_DE => GermanLanguageSeeder::class,
            self::ES_ES => SpanishLanguageSeeder::class,
            self::FR_FR => FrenchLanguageSeeder::class,
            self::IT_IT => ItalianLanguageSeeder::class,
            self::LV_LV => LatvianLanguageSeeder::class,
            self::NL_NL => DutchLanguageSeeder::class,
            self::PT_PT => PortugueseLanguageSeeder::class,
            self::RU_RU => RussianLanguageSeeder::class,
        };

        return $classString;
    }

    public function seeder(): LanguageSeedContract
    {
        $seederClassString = $this->seederClassString();

        return match ($this) {
            self::EN_GB => new class implements LanguageSeedContract
            {
                public function languageEnum(): LanguageEnum
                {
                    return LanguageEnum::EN_GB;
                }

                public function run(): void
                {
                    // leave empty
                }
            },
            default => new $seederClassString,
        };
    }
}
