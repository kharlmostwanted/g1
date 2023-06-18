<?php

namespace App\Http\Livewire;

use App\Models\Household;
use App\Models\Payable;
use Livewire\Component;
use App\Models\Payment;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function getHouseholdsWithUpdatedMonthlyDuesProperty()
    {
        return Household::updatedMonthlyDues()->get();
    }

    public function getHouseholdsWithOutdatedMonthlyDuesProperty()
    {
        return Household::outdatedMonthlyDues()->get();
    }

    public function getTotalCollectibleMonthlyDuesProperty()
    {
        return Payable::whereRelation('item', 'title', 'Monthly Due')
            ->where('due_at', '<=', now())->sum('amount');
    }

    public function getTotalCollectedMonthlyDuesProperty()
    {
        return Payment::whereRelation('item', 'title', 'Monthly Due')
            ->sum('amount');
    }
}
