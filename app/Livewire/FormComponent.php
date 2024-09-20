<?php

namespace App\Livewire;


use Livewire\Component;

abstract class FormComponent extends Component
{

    public string $layouts = 'components.form.forms';
    public array $forms;
    protected array $rules = [];
    public string $form = 'components.form.form-component';

    public function submit()
    {
        foreach ($this->forms() as $item) {
            $this->rules[$item->getName()] = $item->rules();
        }

        $this->validate();

        session()->flash('message', 'Form submitted successfully.');
    }


    public function resetForm()
    {
    }

    public function newForm($component)
    {
        $this->form = $component;
    }

    public function getRules(): array
    {
        $flattenedRules = [];
        foreach ($this->forms(true) as $subArray) {
            $flattenedRules = array_merge($flattenedRules, $subArray);
        }

        return $flattenedRules;
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = $this->form;
        return view($view)
            ->layout($this->layouts);
    }
}
