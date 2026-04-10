<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

trait HasFlagEmojiGetters
{
    /**
     * Get the flag emoji by type.
     *
     * @param  string  $type  The type of flag emoji to return. Defaults to 'img'.
     * @return string|null The flag emoji for the given type.
     */
    public function getFlagEmojiBy(string $type = 'img'): ?string
    {
        return is_array($this->flag_emoji) && isset($this->flag_emoji[$type]) ? $this->flag_emoji[$type] : null;
    }

    /**
     * Get the flag emoji as an image.
     *
     * This method is an alias for `getFlagEmojiImg()`.
     *
     * @return string|null The flag emoji as an image.
     */
    public function getFlagEmoji(): ?string
    {
        return $this->getFlagEmojiImg();
    }

    /**
     * Get the flag emoji as an image.
     *
     * This method is an alias for `getFlagEmojiImg()`.
     *
     * @return string|null The flag emoji as an image.
     */
    public function getFlagEmojiImage(): ?string
    {
        return $this->getFlagEmojiImg();
    }

    /**
     * Get the flag emoji as an image.
     *
     * @return string|null The flag emoji as an image.
     */
    public function getFlagEmojiImg(): ?string
    {
        return $this->getFlagEmojiBy('img');
    }

    /**
     * Get the flag emoji as an image wrapped in an HTML element.
     *
     * This method returns the flag emoji as an image wrapped in an HTML
     * element. The element is a `<span>` element with the flag emoji as its
     * content.
     *
     * @return string The flag emoji as an image wrapped in an HTML element.
     */
    public function getFlagEmojiImgWithHtmlCode(): string
    {
        return <<<HTML
<span>{$this->getFlagEmojiImg()}</span>
HTML;

    }

    /**
     * Get the flag emoji as UTF-8.
     *
     * This method returns the flag emoji as a UTF-8 encoded string.
     *
     * @return string|null The flag emoji as a UTF-8 encoded string.
     */
    public function getFlagEmojiUtf8(): ?string
    {
        return $this->getFlagEmojiBy('utf8');
    }

    /**
     * Get the flag emoji as UTF-8 wrapped in an HTML element.
     *
     * This method returns the flag emoji as a UTF-8 encoded string wrapped
     * in an HTML element. The element is a `<span>` element with the flag
     * emoji as its content.
     *
     * @return string The flag emoji as a UTF-8 encoded string wrapped in an
     *                HTML element.
     */
    public function getFlagEmojiUtf8WithHtmlCode(): string
    {
        return <<<HTML
<span>{$this->getFlagEmojiUtf8()}</span>
HTML;
    }

    /**
     * Get the flag emoji as UTF-16.
     *
     * This method returns the flag emoji as a UTF-16 encoded string.
     *
     * @return string|null The flag emoji as a UTF-16 encoded string.
     */
    public function getFlagEmojiUtf16(): ?string
    {
        return $this->getFlagEmojiBy('utf16');
    }

    /**
     * Get the flag emoji as UTF-16 with HTML and JavaScript.
     *
     * This method returns the flag emoji as a UTF-16 encoded string wrapped
     * in an HTML element, and also includes a JavaScript code to update the
     * HTML element with the flag emoji.
     *
     * @param  string  $divId  The ID of the `<div>` element in which to display
     *                         the flag emoji.
     * @return string The flag emoji as a UTF-16 encoded string wrapped in an
     *                HTML element, and also including a JavaScript code to
     *                update the HTML element with the flag emoji.
     */
    public function getFlagEmojiUtf16WithCode(string $divId = 'emoji-utf16'): string
    {
        return <<<HTML
            {$this->getFlagEmojiUtf16WithHtmlCode($divId)}
            {$this->getFlagEmojiUtf16WithScriptCode($divId, true)}
        HTML;
    }

    /**
     * Get the flag emoji as a UTF-16 encoded string wrapped in an HTML element.
     *
     * This method returns the flag emoji as a UTF-16 encoded string wrapped
     * in an HTML element. The element is a `<span>` element with the flag
     * emoji as its content.
     *
     * @param  string  $divId  The ID of the `<div>` element in which to display
     *                         the flag emoji.
     * @return string The flag emoji as a UTF-16 encoded string wrapped in an
     *                HTML element.
     */
    public function getFlagEmojiUtf16WithHtmlCode(string $divId = 'emoji-utf16'): string
    {
        return <<<HTML
<span id="{$divId}"></span>
HTML;
    }

    /**
     * Get the flag emoji as a UTF-16 encoded string with JavaScript.
     *
     * This method returns the flag emoji as a UTF-16 encoded string, and
     * also includes a JavaScript code to update the HTML element with the
     * given ID to display the flag emoji.
     *
     * @param  string  $divId  The ID of the `<div>` element in which to display
     *                         the flag emoji.
     * @param  bool  $withTag  Whether to return a complete `<script>` tag or
     *                         just the JavaScript code.
     * @return string The flag emoji as a UTF-16 encoded string, and also
     *                including a JavaScript code to update the HTML element
     *                with the flag emoji.
     */
    public function getFlagEmojiUtf16WithScriptCode(string $divId = 'emoji-utf16', bool $withTag = false): string
    {
        if ($withTag) {
            return <<<SCRIPT
<script>
    document.getElementById("{$divId}").innerText = "{$this->getFlagEmojiUtf16()}";
</script>
SCRIPT;
        }

        return <<<SCRIPT
document.getElementById("{$divId}").innerText = "{$this->getFlagEmojiUtf16()}";
SCRIPT;
    }

    /**
     * Get the flag emoji as a Unicode code point.
     *
     * This method is an alias for `getFlagEmojiUCode()`.
     *
     * @return string|null The flag emoji as a Unicode code point.
     */
    public function getFlagEmojiCode(): ?string
    {
        return $this->getFlagEmojiUCode();
    }

    /**
     * Get the flag emoji as a Unicode code point.
     *
     * This method returns the flag emoji as a Unicode code point.
     *
     * @return string|null The flag emoji as a Unicode code point.
     */
    public function getFlagEmojiUCode(): ?string
    {
        return $this->getFlagEmojiBy('uCode');
    }

    /**
     * Get the flag emoji as a hexadecimal representation.
     *
     * This method returns the flag emoji as a hexadecimal representation.
     *
     * @return string|null The flag emoji as a hexadecimal representation.
     */
    public function getFlagEmojiHex(): ?string
    {
        return $this->getFlagEmojiBy('hex');
    }

    /**
     * Get the flag emoji as an HTML element with a hexadecimal representation.
     *
     * This method returns the flag emoji as an HTML element with a hexadecimal
     * representation. The element is a `<span>` element with the hexadecimal
     * representation of the flag emoji as its content.
     *
     * @return string The flag emoji as an HTML element with a hexadecimal representation.
     */
    public function getFlagEmojiHexWithHtmlCode(): string
    {
        return <<<HTML
<span>{$this->getFlagEmojiHex()}</span>
HTML;
    }

    /**
     * Get the flag emoji as an HTML entity.
     *
     * This method returns the flag emoji as an HTML entity.
     *
     * @return string|null The flag emoji as an HTML entity.
     */
    public function getFlagEmojiHtml(): ?string
    {
        return $this->getFlagEmojiBy('html');
    }

    /**
     * Get the flag emoji as an HTML element with an HTML entity.
     *
     * This method returns the flag emoji as an HTML element with an HTML entity.
     * The element is a `<span>` element with the HTML entity of the flag emoji as
     * its content.
     *
     * @return string The flag emoji as an HTML element with an HTML entity.
     */
    public function getFlagEmojiHtmlWithHtmlCode(): string
    {
        return <<<HTML
<span>{$this->getFlagEmojiHtml()}</span>
HTML;
    }

    /**
     * Get the flag emoji as a CSS value.
     *
     * This method returns the flag emoji as a CSS value.
     *
     * @return string|null The flag emoji as a CSS value.
     */
    public function getFlagEmojiCss(): ?string
    {
        return $this->getFlagEmojiBy('css');
    }

    /**
     * Get the flag emoji as a CSS value and HTML.
     *
     * This method returns the flag emoji as a CSS value and HTML.
     *
     * @param  string  $class  The class name for the HTML element.
     * @return string The flag emoji as a CSS value and HTML.
     */
    public function getFlagEmojiCssWithCode($class = 'emoji-css'): string
    {
        return <<<HTML
        {$this->getFlagEmojiCssWithCssCode($class, true)}
        {$this->getFlagEmojiCssWithHtmlCode($class)}
HTML;
    }

    /**
     * Get the flag emoji as a CSS value.
     *
     * This method returns the flag emoji as a CSS value. If `$withStyle` is `true`, it will
     * return a complete CSS style block with a class name of `$class` that can be used to
     * display the emoji. If `$withStyle` is `false`, it will return a CSS rule that can be
     * used to style an element.
     *
     * @param  string  $class  The class name for the HTML element.
     * @param  bool  $withTag  Whether to return a complete CSS style block or just a CSS rule.
     * @return string The flag emoji as a CSS value or a complete CSS style block.
     */
    public function getFlagEmojiCssWithCssCode(string $class = 'emoji-css', bool $withTag = false): string
    {
        if ($withTag) {
            return <<<CSS
<style>
    .{$class}::before {
        content: "{$this->getFlagEmojiCss()}";
    }
</style>
CSS;
        }

        return <<<CSS
.{$class}::before {
    content: "{$this->getFlagEmojiCss()}";
}
CSS;
    }

    /**
     * Get the flag emoji as a HTML element.
     *
     * This method returns the flag emoji as a HTML element. It will generate a `<span>` element
     * with a class name of `$class` that can be used to display the flag emoji. The `alt`
     * attribute of the element is set to a string "Flag of {$this->official_name}".
     *
     * @param  string  $class  The class name for the HTML element.
     * @return string The flag emoji as a HTML element.
     */
    public function getFlagEmojiCssWithHtmlCode(string $class = 'emoji-css'): string
    {
        $altText = property_exists($this, 'official_name') ? 'Flag of '.$this->official_name : '';

        return <<<HTML
<span class="{$class}" alt="{$altText}"></span>
HTML;
    }

    /**
     * Get the flag emoji as a decimal representation.
     *
     * This method returns the flag emoji as a decimal representation.
     *
     * @return string|null The flag emoji as a decimal representation.
     */
    public function getFlagEmojiDecimal(): ?string
    {
        return $this->getFlagEmojiBy('decimal');
    }

    /**
     * Get the flag emoji as a decimal representation wrapped in an HTML element.
     *
     * This method returns the flag emoji as a decimal representation wrapped in an HTML element.
     * The element is a `<span>` element with the flag emoji as its content.
     *
     * @return string The flag emoji as a decimal representation wrapped in an HTML element.
     */
    public function getFlagEmojiDecimalWithHtmlCode(): string
    {
        return <<<HTML
<span>{$this->getFlagEmojiDecimal()}</span>
HTML;
    }

    /**
     * Get the flag emoji as a shortcode.
     *
     * This method returns the flag emoji as a shortcode.
     *
     * @return string|null The flag emoji as a shortcode.
     */
    public function getFlagEmojiShortCode(): ?string
    {
        return $this->getFlagEmojiBy('shortcode');
    }
}
