<?php

use Illuminate\Support\Carbon;
use Lwwcas\LaravelCountries\Enum\LocaleCodeFormatEnum;

return [
    'name' => 'WCountries',

    'locale_key' => config('translatable.locale_key', 'locale'),
    'locale_code_format' => LocaleCodeFormatEnum::ISO_ALPHA_2,

    'cache' => [
        'is_cached' => true,
        'big_time' => Carbon::now()->addDays(120),
        'small_time' => Carbon::now()->addDays(7),
        'prefix' => null,
    ],
];
