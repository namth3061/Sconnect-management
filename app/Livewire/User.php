<?php

namespace App\Livewire;

use Livewire\Component;

class User extends Component
{
    public function render()
    {
        return view('livewire.users.index')
            ->layout('livewire.components.layouts.app', [
                    'title' => 'your title',
                ]
            );
    }
}
