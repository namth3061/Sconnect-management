<?php

namespace App\View\Components\Form;

use Closure;

class Checkbox extends Field
{
    protected string $view = 'components.form.checkbox';
    protected string $type = 'checkbox';

    protected array $options = [];

    /**
     * @param array $options
     */
    public function options(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function inline(bool $isInline = true): static
    {
        $this->is_inline = $isInline;

        return $this;
    }

    public function canSwitch(bool $checked = false): static
    {
        $this->can_switch = true;
        $this->switch_checked = $checked;

        return $this;
    }
}
