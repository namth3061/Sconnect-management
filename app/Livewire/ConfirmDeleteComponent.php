<?php

namespace App\Livewire;

use Livewire\Component;

abstract class ConfirmDeleteComponent extends Component
{

    public string $layouts = 'components.form.forms';

    public function resetForm()
    {
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('components.form.form-comfirm-delete')
            ->layout($this->layouts);
    }
}
