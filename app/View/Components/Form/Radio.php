<?php

namespace App\View\Components\Form;

class Radio extends Field
{
    protected string $view = 'components.form.radio';
    protected string $type = 'radio';
    protected array $options = [];

    public function options($options): static
    {
        $this->options = $options;

        return $this;
    }

    public function inline(bool $isInline = true): static
    {
        $this->is_inline = $isInline;

        return $this;
    }
}
