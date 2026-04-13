<?php

namespace Lwwcas\LaravelCountries\Facades;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Lwwcas\LaravelCountries\Models\Concerns\HasFlagEmojiGetters;

class FlagEmoji
{
    use HasFlagEmojiGetters;

    protected array|FlagEmoji|null $flag_emoji = null;

    /** @var array<string, self> */
    protected array $on_data = [];

    protected ?string $key = null;

    /**
     * FlagEmoji constructor.
     *
     * @param  Collection<string, array|string>|array  $attributes
     */
    public function __construct(protected Collection|array $attributes)
    {
        if ($attributes instanceof Collection) {
            foreach ($attributes as $index => $item) {
                if (! is_array($item)) {
                    $item = json_decode($item, true);
                }

                $this->on_data[$index] = new self($item);
            }
        } else {
            $this->flag_emoji = $attributes;
        }
    }

    /**
     * Return the flag emoji attribute.
     *
     * If `$flagKey` is not set, this method will return a Collection of all flag emoji
     * attributes. If `$flagKey` is set, this method will return the flag emoji
     * attribute at the given key.
     *
     * @param  string|int|null  $flagKey  The key of the flag emoji attribute to return.
     * @return Collection<string, FlagEmoji>|FlagEmoji|null A Collection of all flag emoji attributes, or the flag emoji
     *                                                      attribute at the given key.
     */
    public function get(string|int|null $flagKey = null): Collection|FlagEmoji|null
    {
        if ($flagKey !== null) {
            if (array_key_exists($flagKey, $this->on_data)) {
                return $this->on_data[$flagKey];
            } else {
                return null;
            }
        }

        return collect($this->on_data);
    }

    /**
     * Return the first flag emoji attribute.
     *
     * If the class was constructed with a collection of items, this method will
     * return the first flag emoji attribute from the collection. If the class was
     * constructed with a string, this method will return the flag emoji attribute
     * as a Emoji instance.
     */
    public function first(): array|FlagEmoji|null
    {
        $this->flag_emoji = Arr::first($this->on_data);
        $this->key = Arr::first(array_keys($this->on_data));

        return $this->flag_emoji;
    }

    /**
     * Return the last flag emoji attribute.
     *
     * If the class was constructed with a collection of items, this method will
     * return the last flag emoji attribute from the collection. If the class was
     * constructed with a string, this method will return the flag emoji attribute
     * as a Emoji instance.
     */
    public function last(): array|FlagEmoji|null
    {
        $this->flag_emoji = Arr::last($this->on_data);
        $this->key = array_last(array_keys($this->on_data));

        return $this->flag_emoji;
    }

    /**
     * Return the key of the flag emoji attribute.
     *
     * If the class was constructed with a collection of items, this method will
     * return a collection of the keys from the collection. If the class was
     * constructed with a string, this method will return the key of the flag emoji
     * attribute as a string.
     *
     * @return Collection<int, string>
     */
    public function keys(): Collection
    {
        return collect($this->on_data)->keys();
    }

    /**
     * Return the key of the flag emoji attribute.
     *
     * If the class was constructed with a collection of items, this method will
     * return a collection of the keys from the collection. If the class was
     * constructed with a string, this method will return the key of the flag emoji
     * attribute as a string.
     */
    public function key(): string
    {
        $this->first();

        /** @var string $key */
        $key = $this->key;

        return $key;
    }
}
