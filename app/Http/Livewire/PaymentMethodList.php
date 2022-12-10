<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentMethodList extends Component
{
    protected $listeners = [
        'render' => 'render',
    ];

    public function render()
    {
        $paymentMethods = Auth::user()->paymentMethods();

        return view('livewire.payment-method-list', [
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function deletePaymentMethod($paymentMethodId)
    {
        $paymentMethod = Auth::user()->findPaymentMethod($paymentMethodId);

        $paymentMethod->delete();
    }
}
