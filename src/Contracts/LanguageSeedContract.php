<?php

namespace Lwwcas\LaravelCountries\Contracts;

use Lwwcas\LaravelCountries\Enum\LanguageEnum;

interface LanguageSeedContract
{
    public function languageEnum(): LanguageEnum;
}
