<?php

namespace Lwwcas\LaravelCountries\Enum;

enum LocaleCodeFormatEnum: string
{
    case ISO_ALPHA_2 = 'iso_alpha_2'; // en
    case LOCALE_UNDERSCORE = 'locale_underscore'; // en_GB
    case LOCALE_HYPHEN = 'locale_hyphen'; // en-GB
}
