<?php

namespace App\Http\Livewire\Billing;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subscriptions extends Component
{
    protected $listeners = [
        'render' => 'render',
    ];

    public function render()
    {
        return view('livewire.billing.subscriptions');
    }

    public function newSubscription($name, $price)
    {
        Auth::user()->newSubscription($name, $price)->create();

        $this->emitTo('billing.invoices','render');
    }

    public function changingPlans($name, $price)
    {
        Auth::user()->subscription($name)->swap($price);

        $this->emitTo('billing.invoices','render');
    }

    public function cancellingSubscription($name)
    {
        Auth::user()->subscription($name)->cancel();
    }

    public function resumingSubscription($name)
    {
        Auth::user()->subscription($name)->resume();
    }
}
