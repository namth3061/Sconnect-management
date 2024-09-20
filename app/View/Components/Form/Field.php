<?php

namespace App\View\Components\Form;

use App\Traits\AttributeFields;
use App\Traits\CanBeValidated;
use Closure;

abstract class Field
{
    #https://laravel.com/docs/11.x/validation#rule-in

    use CanBeValidated, AttributeFields;

    protected string $view = '';

    protected string $className = '';

    protected string $default = '';

    protected string $type = '';

    protected string $rules = '';

    protected string $label = '';

    protected string $id = '';

    protected array $options = [];

    protected string $placeholder = '';

    protected $rowNum = null;

    protected bool|Closure $isRequired = false;

    protected $maxValue = null;

    protected $minValue = null;

    protected $maxLength = null;

    protected $minLength = null;

    protected array $field_rules = [];

    protected string $name;

    protected bool $auto_complete = true;

    protected bool $unique = true;

    protected string $input_group_prepend = '';
    protected string $input_group_append = '';
    protected string $url_select = '';
    protected bool $can_switch = false;
    protected bool $switch_checked = false;
    protected bool $is_inline = false;
    protected string $accept = '';
    protected bool $multiple = false;
    protected string $typeFile = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name, bool $isMultipleFile = false): static
    {
        $static = app(static::class, [
            'name' => self::addFileSuffix($name, $isMultipleFile),
        ]);

        return $static;
    }

    public static function removeFileSuffix($name): string
    {
        $suffix = '.*';
        $suffixPosition = strpos($name, $suffix);

        return $suffixPosition ? substr($name, 0, $suffixPosition) : $name;
    }

    public static function addFileSuffix($name, $isMultipleFile): string
    {
        $suffix = $isMultipleFile ? '.*' : '';

        return $name . $suffix;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getListAttributes(): array
    {
        return [
            'view' => $this->view,
            'id' => $this->id,
            'label' => $this->label,
            'type' => $this->type,
            'name' => self::removeFileSuffix($this->name),
            'class' => $this->className,
            'value' => $this->default,
            'required' => $this->isRequired,
            'max' => $this->maxValue,
            'min' => $this->minValue,
            'options' => $this->options,
            'placeholder' => $this->placeholder,
            'rowNum' => $this->rowNum,
            'maxLength' => $this->maxLength,
            'minLength' => $this->minLength,
            'auto_complete' => $this->auto_complete,
            'input_group_append' => $this->input_group_append,
            'input_group_prepend' => $this->input_group_prepend,
            'can_switch' => $this->can_switch,
            'switch_checked' => $this->switch_checked,
            'inline' => $this->is_inline,
            'col' => $this->col,
            'accept' => $this->accept,
            'multiple' => $this->multiple,
            'url_select' => $this->url_select,
            'typeFile' => $this->typeFile,
        ];
    }

    public function rules()
    {
        $this->field_rules[$this->name] = substr($this->rules, 1);

        return $this->field_rules;
    }

    public function setRule($bool = false): array|static
    {
        if ($bool) {
            return $this->rules();
        }

        return $this;
    }

}
