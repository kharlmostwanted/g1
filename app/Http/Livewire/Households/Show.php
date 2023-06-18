<?php

namespace App\Http\Livewire\Households;

use App\Models\Household;
use Livewire\Component;

class Show extends Component
{
    public Household $household;

    public function render()
    {
        if(auth()->check()){
            return view('livewire.households.show');
        }

        return view('livewire.households.show')->layout('layouts.guest');
    }
}
