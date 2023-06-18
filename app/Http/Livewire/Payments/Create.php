<?php

namespace App\Http\Livewire\Payments;

use App\Models\Household;
use Livewire\Component;
use App\Models\Item;
use App\Models\Payment;

class Create extends Component
{
    public Payment $payment;
    public $household_id;
    public $confirmingPayment = false;

    protected $queryString = ['household_id'];

    public function rules()
    {
        return [
            'payment.item_id' => 'required|exists:items,id',
            'payment.household_id' => 'required|exists:households,id',
            'payment.amount' => 'required|numeric|min:0',
        ];
    }

    public function mount()
    {
        $this->payment = new Payment();
        $this->payment->item_id = 1;
        $this->payment->household_id = $this->household_id;
    }

    public function render()
    {
        return view('livewire.payments.create');
    }

    public function getItemsProperty()
    {
        return Item::all();
    }

    public function getItemProperty()
    {
        return Item::find($this->payment->item_id);
    }

    public function getHouseholdProperty()
    {
        return Household::find($this->household_id);
    }

    public function confirmPayment()
    {
        $this->validate();
        $this->confirmingPayment = true;
        // $this->payment->save();
        // return redirect()->route('payments.show', $this->payment);
    }

    public function savePayment()
    {
        $this->payment->save();
        $this->confirmingPayment = false;
        return redirect()->route('payments.show', $this->payment);
    }
}
