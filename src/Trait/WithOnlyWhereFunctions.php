<?php

namespace Lwwcas\LaravelCountries\Trait;

use Illuminate\Support\Collection;
use Lwwcas\LaravelCountries\Facades\FlagEmoji;

trait WithOnlyWhereFunctions
{
    /**
     * Get a list of country IDs.
     *
     * @return Collection<int, int>
     */
    public function onlyId(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('id');
    }

    /**
     * Get a list of country UIDs.
     *
     * @return Collection<int, string>
     */
    public function onlyUid(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('uid');
    }

    /**
     * Get a list of country names.
     *
     * @return Collection<int, string>
     */
    public function onlyName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('name');
    }

    /**
     * Get a list of official country names.
     *
     * @return Collection<int, string>
     */
    public function onlyOfficialName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('official_name');
    }

    /**
     * Get a list of ISO 3166-1 alpha-2 codes.
     *
     * @return Collection<int, string>
     */
    public function onlyIso(): Collection
    {
        return $this->onlyAlpha2();
    }

    /**
     * Get a list of ISO 3166-1 alpha-2 codes.
     *
     * @return Collection<int, string>
     */
    public function onlyAlpha2(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_2');
    }

    /**
     * Get a list of ISO 3166-1 alpha-3 codes.
     *
     * @return Collection<int, string>
     */
    public function onlyAlpha3(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_3');
    }

    /**
     * Get a list of flag emojis.
     */
    public function onlyFlag(): FlagEmoji
    {
        return $this->onlyEmoji();
    }

    /**
     * Get a list of country flag emojis.
     *
     * This method return a list of country flag emojis.
     * The list is cached for a long time to avoid to query the database too much.
     */
    public function onlyEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji');

        return new FlagEmoji($result);
    }

    /**
     * Get a list of flag emojis in a specific format.
     *
     * @param  string  $type  The type of emoji to include. Either 'img', 'utf8', 'utf16', 'html' or 'css'.
     * @return Collection<int, string>
     */
    public function onlyEmojiIn(string $type): Collection
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji');

        return $result->pluck($type);
    }

    /**
     * Get a list of country flag emojis as images.
     *
     * This method return a list of country flag emojis as images.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInImg(): Collection
    {
        return $this->onlyEmojiIn('img');
    }

    /**
     * Get a list of country flag emojis as UTF-8 strings.
     *
     * This method returns a list of country flag emojis as UTF-8 strings.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInUtf8(): Collection
    {
        return $this->onlyEmojiIn('utf8');
    }

    /**
     * Get a list of country flag emojis as UTF-16 strings.
     *
     * This method returns a list of country flag emojis as UTF-16 strings.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInUtf16(): Collection
    {
        return $this->onlyEmojiIn('utf16');
    }

    /**
     * Get a list of country flag emojis as HTML entities.
     *
     * This method returns a list of country flag emojis as HTML entities.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInHtml(): Collection
    {
        return $this->onlyEmojiIn('html');
    }

    /**
     * Get a list of country flag emojis as CSS values.
     *
     * This method returns a list of country flag emojis as CSS values.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInCss(): Collection
    {
        return $this->onlyEmojiIn('css');
    }

    /**
     * Get a list of country flag emojis as hex codes.
     *
     * This method returns a list of country flag emojis as hex codes.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInHex(): Collection
    {
        return $this->onlyEmojiIn('hex');
    }

    /**
     * Get a list of country flag emojis as Unicode code points.
     *
     * This method returns a list of country flag emojis as Unicode code points.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInUCode(): Collection
    {
        return $this->onlyEmojiIn('uCode');
    }

    /**
     * Get a list of country flag emojis as decimal representations.
     *
     * This method returns a list of country flag emojis as decimal representations.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInDecimal(): Collection
    {
        return $this->onlyEmojiIn('decimal');
    }

    /**
     * Get a list of country flag emojis as shortcodes.
     *
     * This method returns a list of country flag emojis as shortcodes.
     * The list is cached for a long time to avoid to query the database too much.
     *
     * @return Collection<int, string>
     */
    public function onlyEmojiInShortCode(): Collection
    {
        return $this->onlyEmojiIn('shortcode');
    }
}
