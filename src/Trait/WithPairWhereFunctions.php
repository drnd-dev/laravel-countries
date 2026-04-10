<?php

namespace Lwwcas\LaravelCountries\Trait;

use Illuminate\Support\Collection;
use Lwwcas\LaravelCountries\Facades\FlagEmoji;

trait WithPairWhereFunctions
{
    /**
     * Get a list of countries with their ids and official names.
     *
     * This method returns a list of countries with their ids and official names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<int, string>
     */
    public function idAndOfficialName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('official_name', 'id');
    }

    /**
     * Get a list of countries with their ids and UIDs.
     *
     * This method returns a list of countries with their ids and UIDs.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<int, string>
     */
    public function idAndUid(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('uid', 'id');
    }

    /**
     * Get a list of countries with their ids and names.
     *
     * This method returns a list of countries with their ids and names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<int, string>
     */
    public function idAndName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('name', 'id');
    }

    /**
     * Get a list of countries with their ids and iso_alpha_2 codes.
     *
     * This method returns a list of countries with their ids and iso_alpha_2 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<int, string>
     */
    public function idAndAlpha2(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_2', 'id');
    }

    /**
     * Get a list of countries with their ids and iso_alpha_3 codes.
     *
     * This method returns a list of countries with their ids and iso_alpha_3 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<int, string>
     */
    public function idAndAlpha3(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_3', 'id');
    }

    /**
     * Get a list of countries with their ids and emojis.
     *
     * This method returns a list of countries with their ids and emojis.
     * The list is cached for a long time to avoid querying the database too much.
     */
    public function idAndEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji', 'id');

        return new FlagEmoji($result);
    }

    /**
     * Get a list of countries with their uids and names.
     *
     * This method returns a list of countries with their uids and names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function uidAndName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('name', 'uid');
    }

    /**
     * Get a list of countries with their uids and official names.
     *
     * This method returns a list of countries with their uids and official names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function uidAndOfficialName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('official_name', 'uid');
    }

    /**
     * Get a list of countries with their uids and iso_alpha_2 codes.
     *
     * This method returns a list of countries with their uids and iso_alpha_2 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function uidAndAlpha2(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_2', 'uid');
    }

    /**
     * Get a list of countries with their uids and iso_alpha_3 codes.
     *
     * This method returns a list of countries with their uids and iso_alpha_3 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function uidAndAlpha3(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_3', 'uid');
    }

    /**
     * Get a list of countries with their uids and emojis.
     *
     * This method returns a list of countries with their uids and emojis.
     * The list is cached for a long time to avoid querying the database too much.
     */
    public function uidAndEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji', 'uid');

        return new FlagEmoji($result);
    }

    /**
     * Get a list of countries with their names and official names.
     *
     * This method returns a list of countries with their names and official names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function nameAndOfficialName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('official_name', 'name');
    }

    /**
     * Get a list of countries with their names and iso_alpha_2 codes.
     *
     * This method returns a list of countries with their names and iso_alpha_2 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function nameAndAlpha2(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_2', 'name');
    }

    /**
     * Get a list of countries with their names and iso_alpha_3 codes.
     *
     * This method returns a list of countries with their names and iso_alpha_3 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function nameAndAlpha3(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_3', 'name');
    }

    /**
     * Get a list of countries with their names and emojis.
     *
     * This method returns a list of countries with their names and emojis.
     * The list is cached for a long time to avoid querying the database too much.
     */
    public function nameAndEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji', 'name');

        return new FlagEmoji($result);
    }

    /**
     * Get a list of countries with their official names and iso_alpha_2 codes.
     *
     * This method returns a list of countries with their official names and iso_alpha_2 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function officialNameAndAlpha2(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_2', 'official_name');
    }

    /**
     * Get a list of countries with their official names and iso_alpha_3 codes.
     *
     * This method returns a list of countries with their official names and iso_alpha_3 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function officialNameAndAlpha3(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_3', 'official_name');
    }

    /**
     * Get a list of countries with their official names and emojis.
     *
     * This method returns a list of countries with their official names and emojis.
     * The list is cached for a long time to avoid querying the database too much.
     */
    public function officialNameAndEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji', 'official_name');

        return new FlagEmoji($result);
    }

    /**
     * Get a list of countries with their iso_alpha_2 codes and ids.
     *
     * This method returns a list of countries with their iso_alpha_2 codes and ids.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, int>
     */
    public function alpha2AndId(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('id', 'iso_alpha_2');
    }

    /**
     * Get a list of countries with their iso_alpha_2 codes and UIDs.
     *
     * This method returns a list of countries with their iso_alpha_2 codes and UIDs.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha2AndUid(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('uid', 'iso_alpha_2');
    }

    /**
     * Get a list of countries with their iso_alpha_2 codes and names.
     *
     * This method returns a list of countries with their iso_alpha_2 codes and names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha2AndName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('name', 'iso_alpha_2');
    }

    /**
     * Get a list of countries with their iso_alpha_2 codes and official names.
     *
     * This method returns a list of countries with their iso_alpha_2 codes and official names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha2AndOfficialName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('official_name', 'iso_alpha_2');
    }

    /**
     * Get a list of countries with their iso_alpha_2 and iso_alpha_3 codes.
     *
     * This method returns a list of countries with their iso_alpha_2 and iso_alpha_3 codes.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha2AndAlpha3(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('iso_alpha_3', 'iso_alpha_2');
    }

    /**
     * Get a list of countries with their iso_alpha_2 codes and emojis.
     *
     * This method returns a list of countries with their iso_alpha_2 codes and emojis.
     * The list is cached for a long time to avoid querying the database too much.
     */
    public function alpha2AndEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji', 'iso_alpha_2');

        return new FlagEmoji($result);
    }

    /**
     * Get a list of countries with their iso_alpha_3 codes and ids.
     *
     * This method returns a list of countries with their iso_alpha_3 codes and ids.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, int>
     */
    public function alpha3AndId(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('id', 'iso_alpha_3');
    }

    /**
     * Get a list of countries with their iso_alpha_3 codes and UIDs.
     *
     * This method returns a list of countries with their iso_alpha_3 codes and UIDs.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha3AndUid(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('uid', 'iso_alpha_3');
    }

    /**
     * Get a list of countries with their iso_alpha_3 codes and names.
     *
     * This method returns a list of countries with their iso_alpha_3 codes and names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha3AndName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('name', 'iso_alpha_3');
    }

    /**
     * Get a list of countries with their iso_alpha_3 codes and official names.
     *
     * This method returns a list of countries with their iso_alpha_3 codes and official names.
     * The list is cached for a long time to avoid querying the database too much.
     *
     * @return Collection<string, string>
     */
    public function alpha3AndOfficialName(): Collection
    {
        return $this->withNamesAndSlugs()->pluck('official_name', 'iso_alpha_3');
    }

    /**
     * Get a list of countries with their iso_alpha_3 codes and emojis.
     *
     * This method returns a list of countries with their iso_alpha_3 codes and emojis.
     * The list is cached for a long time to avoid querying the database too much.
     */
    public function alpha3AndEmoji(): FlagEmoji
    {
        $result = $this->withNamesSlugsAndFlags()->pluck('flag_emoji', 'iso_alpha_3');

        return new FlagEmoji($result);
    }
}
