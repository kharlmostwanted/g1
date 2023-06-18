<?php

namespace App\Http\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;

class Show extends Component
{
    public Payment $payment;

    public function render()
    {
        return view('livewire.payments.show');
    }
}
