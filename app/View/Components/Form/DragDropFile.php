<?php

namespace App\View\Components\Form;

class DragDropFile extends Field
{

    protected string $view = 'components.form.drag-drop-file';

    public function isImage($value = 'jpg,jpeg,png,gif,ico', $nullable = true): static
    {
        $this->typeFile = 'image';

        $this->rule("image|mimes:{$value}");

        $nullable && $this->rule("nullable");

        return $this;
    }

    public function isFile($nullable = true): static
    {
        $this->typeFile = 'file';

        $nullable && $this->rule("nullable");

        return $this;
    }

    public function maxSize($value, $nullable = true): static
    {
        $this->rule("max:{$value}");

        $nullable && $this->rule("nullable");

        return $this;
    }

    public function accept($value): static
    {
        $this->accept = $value;

        return $this;
    }

    public function isMultiple($value = true): static
    {
        $this->multiple = $value;

        return $this;
    }

}
