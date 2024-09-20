<?php

namespace App\Livewire;

use Livewire\Component;

class Tenant extends Component
{

    public function render()
    {
        return view('livewire.tenant.index')
            ->layout('livewire.components.layouts.app', [
                    'title' => 'your title',
                ]
            );

    }
}
