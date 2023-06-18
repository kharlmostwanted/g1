<?php

namespace App\Http\Livewire\Households;

use Livewire\Component;
use App\Models\Household;
use Livewire\WithPagination;

class Index extends Component
{
    public $perPage = 10;
    public $search;
    public $filter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => ''],
    ];

    use WithPagination;

    public function render()
    {
        return view('livewire.households.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getHouseholdsProperty()
    {
        return Household::query()
            ->when(!empty($this->search), function ($query) {
                $query->where('title', 'like',  $this->search . '%')
                    ->orWHere('street', 'like', '%' . $this->search . '%')
                    ->orWhereHas('owner', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })->when($this->filter == 'updated', function ($query) {
                $query->updatedMonthlyDues();
            })->when($this->filter == 'outdated', function ($query) {
                $query->outdatedMonthlyDues();
            })->orderBy('title')->paginate($this->perPage);
    }
}
