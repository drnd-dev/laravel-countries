<?php

namespace Lwwcas\LaravelCountries\Trait;

use Lwwcas\LaravelCountries\Enum\LanguageEnum;
use Lwwcas\LaravelCountries\Models\CountryRegionTranslation as RegionsLanguages;

trait WithLanguages
{
    public function getSelectableLanguageSeedersByTitle(): array
    {
        $languages = array_combine(
            array_map(fn (LanguageEnum $case) => $case->title(), LanguageEnum::cases()),
            array_map(fn (LanguageEnum $case) => $case->seederClassString(), LanguageEnum::cases()),
        );

        $languages['None'] = null;
        $languages['All'] = null;

        return $languages;
    }

    public function getLanguagesByCode(): array
    {
        return array_combine(
            array_map(fn (LanguageEnum $case) => $case->formatFromConfig(), LanguageEnum::cases()),
            array_map(fn (LanguageEnum $case) => $case->title(), LanguageEnum::cases()),
        );
    }

    /**
     * Ask the user if they want to run the seeds for the languages
     * that are not English.
     *
     * @return $this
     */
    public function askToRunSeeds(?array $languages = null): self
    {
        if ($languages === null) {
            $languages = array_keys($this->getSelectableLanguageSeedersByTitle());
            $key = array_search(LanguageEnum::EN_GB->title(), $languages);
            if ($key !== false) {
                unset($languages[$key]); // English
            }
        }

        $this->info('English is the default language and must be installed.');
        $this->info('However, other translations are optional.');
        $this->info('The following translations are available:');

        $languagesTable = array_values($languages);
        $noneKey = array_search('None', $languagesTable);
        $allKey = array_search('All', $languagesTable);
        if ($noneKey !== false) {
            unset($languagesTable[$noneKey], $languagesTable[$allKey]);
        }

        $this->table(
            ['Language'],
            [$languagesTable]
        );
        $this->newLine();

        $this->comment('(You can select multiple options)');
        $this->comment('like this: "4, 3, 6"');

        $selectedLanguages = [];
        $languagesConfirmed = false;
        do {
            /** @var array $selectedLanguages */
            $selectedLanguages = $this->choice(
                'Please select the languages you want to install:',
                $languages,
                null, // Default value (none by default)
                null, // Number of attempts
                true  // Allow multiple selection
            );

            $selectedLanguages = array_unique($selectedLanguages);
            if (in_array('None', $selectedLanguages)) {
                $this->info('You chose not to install any additional languages.');
            } elseif (in_array('All', $selectedLanguages)) {
                $this->info('You chose to install all available languages.');
            } else {
                $this->info('You have selected the following languages:');
                $this->info(implode(', ', $selectedLanguages));
            }

            $languagesConfirmed = $this->confirm('Do you want to choose again?', false);
        } while ($languagesConfirmed);

        $this->runSeeds($selectedLanguages);

        $this->newLine();

        return $this;
    }

    /**
     * Run the selected language seeds.
     *
     * @return $this
     */
    public function runSeeds(array $selectedLanguages): self
    {
        if (in_array('None', $selectedLanguages)) {
            $selectedLanguages = [];
            array_unshift($selectedLanguages, LanguageEnum::EN_GB->title());
        }

        if (in_array('All', $selectedLanguages)) {
            $selectedLanguages = array_keys($this->getSelectableLanguageSeedersByTitle());
            $noneKey = array_search('None', $selectedLanguages);
            $allKey = array_search('All', $selectedLanguages);
            unset($selectedLanguages[$noneKey], $selectedLanguages[$allKey]);
        }

        // English must be the first language on the array, because it's the default
        if (in_array(LanguageEnum::EN_GB->title(), $selectedLanguages) === false) {
            $enLocale = RegionsLanguages::select('locale')
                ->where('locale', LanguageEnum::defaultLanguage()->formatFromConfig())
                ->limit(1)
                ->first();

            if ($enLocale === null) {
                array_unshift($selectedLanguages, LanguageEnum::EN_GB->title());
            }
        }

        $filteredLanguages = collect($this->getSelectableLanguageSeedersByTitle())
            ->filter(function ($class, $language) use ($selectedLanguages) {
                return in_array($language, $selectedLanguages);
            })
            ->all();

        $this->comment('Running languages...');
        foreach ($filteredLanguages as $language => $seeder) {
            $this->callSilently('db:seed', [
                '--class' => $seeder,
            ]);
            $this->comment("{$language} executed successfully.");
        }

        $this->info('Seeds executed successfully!');

        return $this;
    }
}
