<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        $assets = ['chart', 'animation'];
        return view('livewire.dashboards.dashboard')
            ->layout('livewire.components.layouts.app', [
                    'title' => 'your title',
                    'assets' => $assets
                ]
            );

    }
}
