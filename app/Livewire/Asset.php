<?php

namespace App\Livewire;

use Livewire\Component;

class Asset extends Component
{

    public string $title = 'your title';
    public string $layouts = 'livewire.components.layouts.app';

    public function render()
    {
        return view('livewire.asset')
            ->layout($this->layouts, [
                'title' => $this->title,
            ]);
    }
}
