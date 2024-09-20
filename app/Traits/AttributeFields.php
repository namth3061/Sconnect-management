<?php


namespace App\Traits;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Unique;

trait AttributeFields
{

    protected string $label = '';
    protected string $id = '';
    protected string $className = '';
    protected string $default = '';
    protected string $type = '';
    protected string $placeholder = '';
    protected string $col = '';


    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function hasId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function className(string $className): static
    {
        $this->className = $className;

        return $this;
    }

    public function default(string $default): static
    {
        $this->default = $default;

        return $this;
    }


    public function type(string $type = "text"): static
    {
        $this->type = $type;

        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function autoComplete(bool $allow = true): static
    {
        $this->auto_complete = $allow;

        return $this;
    }

    public function inputGroupPrepend(string $content = ''): static
    {
        $this->input_group_prepend = $content;

        return $this;
    }

    public function inputGroupAppend(string $content = ''): static
    {
        $this->input_group_append = $content;

        return $this;
    }

    public function col(string $_col): static
    {
        $this->col = $_col;

        return $this;
    }

}
