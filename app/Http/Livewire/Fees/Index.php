<?php

namespace App\Http\Livewire\Fees;

use Livewire\Component;
use App\Models\Fee;

class Index extends Component
{
    public function render()
    {
        return view('livewire.fees.index');
    }

    public function getFeesProperty()
    {
        return Fee::query()
            ->withCasts([
                'due_at' => 'datetime',
            ])
            ->paginate(12);
    }
}
