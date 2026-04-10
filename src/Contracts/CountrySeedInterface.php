<?php

namespace Lwwcas\LaravelCountries\Contracts;

interface CountrySeedInterface
{
    /**
     * Run the database seeds.
     */
    public function run(): void;

    public function geographical(): string;
}
