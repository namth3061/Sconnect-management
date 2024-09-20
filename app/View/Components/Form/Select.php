<?php
namespace App\View\Components\Form;

use Closure;

class Select extends Field
{
    protected string $view = 'components.form.select';

    protected array $options = [];

    protected string $url_select = '';
    
    /**
     * @param array $options
     */
    public function options(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;

        return $this;
    }
    
    public function urlSelect(string $url_select = ''): static
    {
        $this->url_select = $url_select;
        
        return $this;
    }
}
