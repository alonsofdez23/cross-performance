<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subscriptions extends Component
{
    public function render()
    {
        return view('livewire.subscriptions');
    }

    public function newSubscription($name, $price)
    {
        $subscription = Auth::user()->newSubscription($name, $price);
        $subscription->create();
    }
}
