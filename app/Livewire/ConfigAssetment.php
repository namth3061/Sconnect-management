<?php

namespace App\Livewire;


use Livewire\Component;

class ConfigAssetment extends Component
{

    public string $layouts = 'livewire.components.layouts.app';

    public function render()
    {
        return view('livewire.tenant.index')
            ->layout('livewire.components.layouts.app', [
                    'title' => 'your title',
                ]
            );
    }


}
