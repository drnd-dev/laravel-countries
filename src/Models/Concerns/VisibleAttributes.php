<?php

namespace Lwwcas\LaravelCountries\Models\Concerns;

trait VisibleAttributes
{
    /**
     * Determine if the model is visible.
     */
    public function isVisible(): bool
    {
        return (bool) $this->is_visible;
    }

    /**
     * Determine if the model is hidden.
     */
    public function isHidden(): bool
    {
        return ! $this->is_visible;
    }

    /**
     * Set the model as visible.
     *
     * @return $this
     */
    public function setVisibleTrue(): self
    {
        $this->is_visible = true;
        $this->save();

        return $this;
    }

    /**
     * Set the model as hidden.
     *
     * @return $this
     */
    public function setVisibleFalse(): self
    {
        $this->is_visible = false;
        $this->save();

        return $this;
    }

    /**
     * Set the visible attributes for the model.
     *
     * @return $this
     */
    public function setModelVisible(): self
    {
        $this->is_visible = true;
        $this->save();

        return $this;
    }

    /**
     * Set the hidden attributes for the model.
     *
     * @return $this
     */
    public function setModelHidden(): self
    {
        $this->is_visible = false;
        $this->save();

        return $this;
    }
}
