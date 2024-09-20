<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        $assets = ['chart', 'animation'];
        return view('livewire.counter')
            ->layout('livewire.components.layouts.app', [
                    'title' => 'your title',
                    'assets' => $assets
                ]
            );

    }
}
