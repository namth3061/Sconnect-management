<?php

namespace App\View\Components\Form;

use Closure;

class TextInput extends Field
{

    protected string $view = 'components.form.text-input';

    protected $maxValue = null;
    protected $minValue = null;
    protected $maxlength = null;
    protected $minLength = null;
    protected $url = null;

    /**
     * @param scalar | Closure | null $value
     */
    public function maxValue($value, $nullable = true): static
    {
        $this->maxValue = $value;

        $this->rule("max:{$value}");

        $nullable && $this->rule("nullable");

        return $this;
    }

    /**
     * @param scalar | Closure | null $value
     */
    public function minValue($value, $nullable = true): static
    {

        $this->minValue = $value;

        $this->rule("min:{$value}");

        $nullable && $this->rule("nullable");

        return $this;
    }

    /**
     * @param scalar | Closure | null $value
     */
    public function maxLength($value, $nullable = true): static
    {
        $this->maxLength = $value;

        $this->rule("max:{$value}");

        $nullable && $this->rule("nullable");

        return $this;
    }

    /**
     * @param scalar | Closure | null $value
     */
    public function minLength($value, $nullable = true): static
    {
        $this->minLength = $value;

        $this->rule("min:{$value}");

        $nullable && $this->rule("nullable");

        return $this;
    }

    public function isUrl($url = true, $nullable = true): static
    {
        $this->url = $url;

        $this->rule("url");

        $nullable && $this->rule("nullable");

        return $this;
    }

}
