<?php

namespace App\View\Components\Form;

class UploadFile extends Field
{

    protected string $view = 'components.form.upload-file';

    public function isImage($value = 'jpg,jpeg,png,gif,ico', $nullable = true): static
    {
        $this->typeFile = 'image';

        $this->rule("image|mimes:{$value}");

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
