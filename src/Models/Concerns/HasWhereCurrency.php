<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasWhereCurrency
{
    /**
     * Filter countries by currency.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereCurrency(Builder $query, string $currency): Builder
    {
        return $query->whereCurrencyCode($currency);
    }

    /**
     * Filter countries by an array of currencies.
     *
     * @param  Builder<static>  $query
     * @param  string[]  $currencies
     * @return Builder<static>
     */
    #[Scope]
    protected function whereCurrencies(Builder $query, array $currencies): Builder
    {
        return $query->whereCurrencyCodes($currencies);
    }

    /**
     * Filter countries by currency code.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereCurrencyCode(Builder $query, string $currency): Builder
    {
        return $query->whereJsonContains('currency->code', $currency);
    }

    /**
     * Filter countries by an array of currencies code.
     *
     * @param  Builder<static>  $query
     * @param  string[]  $currencies
     * @return Builder<static>
     */
    #[Scope]
    protected function whereCurrencyCodes(Builder $query, array $currencies): Builder
    {
        return $query->where(function (Builder $query) use ($currencies) {
            foreach ($currencies as $code) {
                $query->orWhereJsonContains('currency->code', $code);
            }
        });
    }

    /**
     * Filter countries by currency name.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function whereCurrencyName(Builder $query, string $currency): Builder
    {
        return $query->whereJsonContains('currency->name', $currency);
    }

    /**
     * Filter countries by an array of currencies name.
     *
     * @param  Builder<static>  $query
     * @param  string[]  $currencies
     * @return Builder<static>
     */
    #[Scope]
    protected function whereCurrencyNames(Builder $query, array $currencies): Builder
    {
        return $query->where(function (Builder $query) use ($currencies) {
            foreach ($currencies as $name) {
                $query->orWhereJsonContains('currency->name', $name);
            }
        });
    }

    /**
     * Checks if the country has a currency defined.
     *
     * @phpstan-assert-if-true array $this->currency
     */
    public function hasCurrency(): bool
    {
        return is_array($this->currency) && ! empty($this->currency['code']);
    }

    /**
     * Checks if the country has a currency with coins defined.
     */
    public function hasCoinsCurrency(): bool
    {
        return $this->hasCurrency() && is_array($this->currency['coins']) && ! empty($this->currency['coins']);
    }

    /**
     * Checks if the country has a currency with sub coins defined.
     */
    public function hasSubCoinsCurrency(): bool
    {
        return $this->hasCoinsCurrency() && ! empty($this->currency['coins']['sub']);
    }

    /**
     * Checks if the country has a currency with main coins defined.
     */
    public function hasMainCoinsCurrency(): bool
    {
        return $this->hasCoinsCurrency() && ! empty($this->currency['coins']['main']);
    }

    /**
     * Checks if the country has a currency with notes defined.
     */
    public function hasNotesCurrency(): bool
    {
        return $this->hasCurrency() && ! empty($this->currency['banknotes']);
    }

    /**
     * Returns an array with the currency name, code and symbol.
     * If any of them is not defined, it will return null.
     */
    public function getCurrency(): array
    {
        return [
            'name' => $this->getCurrencyName() ?? null,
            'code' => $this->getCurrencyCode() ?? null,
            'symbol' => $this->getCurrencySymbol() ?? null,
        ];
    }

    /**
     * Returns an array with all the currency data, including name, code, symbol, unit of currency, banknotes and coins.
     * If any of them is not defined, it will return null.
     */
    public function getCurrencyData(): array
    {
        return [
            'name' => $this->getCurrencyName() ?? null,
            'code' => $this->getCurrencyCode() ?? null,
            'symbol' => $this->getCurrencySymbol() ?? null,
            'unit' => [
                'main' => $this->getCurrencyMainUnit() ?? null,
                'sub' => $this->getCurrencySubUnit() ?? null,
                'to_unit' => $this->getCurrencyUnitMainToSub(),
            ],
            'banknotes' => $this->getCurrencyNotes(),
            'coins' => [
                'main' => $this->getCurrencyMainCoins(),
                'sub' => $this->getCurrencySubCoins(),
            ],
        ];
    }

    /**
     * Get the currency code of the country.
     */
    public function getCurrencyCode(): ?string
    {
        return $this->currency['code'] ?? null;
    }

    /**
     * Get the currency name of the country.
     */
    public function getCurrencyName(): ?string
    {
        return $this->currency['name'] ?? null;
    }

    /**
     * Get the currency symbol of the country.
     */
    public function getCurrencySymbol(): ?string
    {
        return $this->currency['symbol'] ?? null;
    }

    /**
     * Get the main unit of the currency of the country.
     */
    public function getCurrencyMainUnit(): ?string
    {
        return $this->currency['unit']['main'] ?? null;
    }

    /**
     * Get the sub unit of the currency of the country.
     */
    public function getCurrencySubUnit(): ?string
    {
        return $this->currency['unit']['sub'] ?? null;
    }

    /**
     * Get the number of sub units that equals 1 main unit of the currency of the country.
     */
    public function getCurrencyUnitMainToSub(): int
    {
        return $this->currency['unit']['to_unit'] ?? 1;
    }

    /**
     * Get the main coins of the currency of the country.
     *
     * @return array<int, string>
     */
    public function getCurrencyMainCoins(): array
    {
        return $this->currency['coins']['main'] ?? [];
    }

    /**
     * Get the sub coins of the currency of the country.
     *
     * @return array<int, string>
     */
    public function getCurrencySubCoins(): array
    {
        return $this->currency['coins']['sub'] ?? [];
    }

    /**
     * Get the banknotes of the currency of the country.
     *
     * @return array<int, string>
     */
    public function getCurrencyNotes(): array
    {
        return $this->currency['banknotes'] ?? [];
    }
}
