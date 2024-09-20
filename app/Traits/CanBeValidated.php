<?php


namespace App\Traits;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Unique;

trait CanBeValidated
{
    protected bool|Closure $isRequired = false;

    /**
     * @var array<mixed>
     */
    protected string $rules = '';
    protected bool $unique = true;


    public function in(array|Arrayable|string|Closure $values): static
    {
        $this->rule("in:{$values}");

        return $this;
    }

    public function notIn(array|Arrayable|string|Closure $values): static
    {
        $this->rule("not_in:{$values}");

        return $this;
    }


    public function required(bool|Closure $condition = true): static
    {
        $this->isRequired = $condition;

        $condition && $this->rule('required');

        return $this;
    }

    public function unique(string $table, bool $allow = true): static
    {
        $this->unique = $allow;

        $this->rule('unique:' . $table);

        return $this;
    }

    public function rule(mixed $rule, bool|Closure $condition = true): static
    {

        $this->rules .= '|' . $rule;

        return $this;
    }


}
