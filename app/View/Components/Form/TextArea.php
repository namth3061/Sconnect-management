<?php

namespace App\View\Components\Form;

use Closure;

class TextArea extends Field
{
    protected string $view = 'components.form.text-area';
    protected $maxlength = null;
    protected $minLength = null;
    protected $rowNum = 0;

    public function mount()
    {
    }

    /**
     * @param scalar | Closure | null $value
     */
    public function maxLength($value): static
    {
        $this->maxLength = $value;

        $this->rule("max:{$value}");

        return $this;
    }

    /**
     * @param scalar | Closure | null $value
     */
    public function minLength($value): static
    {
        $this->minLength = $value;

        $this->rule("min:{$value}");

        return $this;
    }

    /**
     * @param scalar | Closure | null $value
     */
    public function rowNum($rowNum): static
    {

        $this->rowNum = $rowNum;

        return $this;
    }

    /**
    * Add "id" for Textarea component and use summnernote() to apply Summernote editing.
    * Use syntax to update value #[On('update-[id]')]
    * Example: CreateProcess.php class
    * Note: If Textarea has className then add summnernote() below className()
    */
    public function summernote(): static
    {
        $this->className .= " summernote ";

        return $this;
    }

}
