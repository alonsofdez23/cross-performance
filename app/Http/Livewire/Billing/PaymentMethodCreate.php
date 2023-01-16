<?php

namespace App\Http\Livewire\Billing;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentMethodCreate extends Component
{
    protected $listeners = [
        'paymentMethodCreate' => 'paymentMethodCreate'
    ];

    public function render()
    {
        $this->emit('resetStripe');

        return view('livewire.billing.payment-method-create', [
            'intent' => Auth::user()->createSetupIntent(),
        ]);
    }

    public function paymentMethodCreate($paymentMethod)
    {
        if (Auth::user()->hasPaymentMethod()) {
            Auth::user()->addPaymentMethod($paymentMethod);
        } else {
            if (!Auth::user()->hasStripeId()) {
                Auth::user()->createAsStripeCustomer();
            }
            Auth::user()->updateDefaultPaymentMethod($paymentMethod);
        }


        $this->emitTo('billing.payment-method-list', 'render');
        $this->emitTo('billing.subscriptions', 'render');
        $this->emitTo('alerta-pago', 'render');
    }
}
